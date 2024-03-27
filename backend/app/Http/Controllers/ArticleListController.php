<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleListResource;
use App\Services\LinkhouseApiService;
use Illuminate\Http\Request;
use Saloon\XmlWrangler\XmlReader;

class ArticleListController extends Controller
{
    protected $linkhouseApiService;

    public function __construct()
    {
        $this->linkhouseApiService = new LinkhouseApiService();
    }

    public function index(Request $request)
    {
        try {
            $lang = $request->query('lang', 'pl');
            $feedResponse = $this->linkhouseApiService->fetchFeed($lang);
            $xmlValues = $this->parseXmlValues(is_string($feedResponse) ? $feedResponse : $feedResponse->body());

            if (empty ($xmlValues['rss']['channel']['item'])) {
                return response()->json(['error' => 'No articles found.'], 404);
            }

            $articleList = $this->remodel($xmlValues['rss']['channel']['item']);

            return response()->json($articleList);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch articles. Please try again later.'], 500);
        }
    }

    protected function parseXmlValues($xmlBody)
    {
        return XmlReader::fromString($xmlBody)->values();
    }

    protected function remodel($articles)
    {
        return collect($articles)->map(function ($article) {
            return new ArticleListResource($article);
        });
    }
}
