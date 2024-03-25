<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Saloon\XmlWrangler\XmlReader;

class ArticleListController extends Controller
{
    public function index()
    {
        $feed_response = Http::get('https://linkhouse.pl/feed/'); 
       
        if ($feed_response->failed()) {
            return response()->json([
                'error' => 'Failed to fetch articles. Please try again later.'
            ], 500);
        }

        $xml_body = $feed_response->body();
        $xml_values = XmlReader::fromString($xml_body)->values();
        $article_list = [];

        foreach ($xml_values['rss']['channel']['item'] as $article) {
            $article_list[] = [
                'title' => $article['title'],
                'link' => $article['link'],
                'comments' => $article['comments'],
                'pubDate' => $article['pubDate'],
                'category' => is_array($article['category']) ? $article['category'] : [$article['category']],
                'guid' => $article['guid'],
                'description' => $article['description'],
            ];
        }

        if (empty($article_list)) {
            return response()->json([
                'error' => 'No articles found.'
            ], 404);
        }

        return response()->json($article_list);
    }
}
