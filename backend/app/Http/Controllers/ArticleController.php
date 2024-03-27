<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Services\LinkhouseApiService;
use Illuminate\Http\Request;
use Saloon\XmlWrangler\XmlReader;
use Illuminate\Support\Facades\Log;

class ArticleController extends Controller
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
                return response()->json(['error' => 'Article found.'], 404);
            }

            $fullArticle = $this->findArticle($xmlValues['rss']['channel']['item'], $request->route('id'), $lang);

            if ($fullArticle === null) {
                return response()->json(['error' => 'Article not found.'], 404);
            }

            $article = $this->remodel($fullArticle);

            return response()->json($article);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch Article. Please try again later.'], 500);
        }
    }
    protected function parseXmlValues($xmlBody)
    {
        return XmlReader::fromString($xmlBody)->values();
    }

    protected function remodel($articles)
    {
        return new ArticleResource($articles);
    }

    protected function findArticle($articles, $id, $lang)
    {
        Log::info($id);
        foreach ($articles as $article) {
            if ($article['guid'] === 'https://linkhouse.' . $lang . '/?p=' . $id) {
                return $article;
            }
        }

        return null;
    }
}
