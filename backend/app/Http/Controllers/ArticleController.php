<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Saloon\XmlWrangler\XmlReader;

class ArticleController extends Controller
{
    public function index(string $slug)
    {
        $feed_response = Http::get('https://linkhouse.pl/feed/'); 
       
        if ($feed_response->failed()) {
            return response()->json([
                'error' => 'Failed to fetch article.',
            ], 500);
        }

        $xml_body = $feed_response->body();
        $xml_values = XmlReader::fromString($xml_body)->values();
        $article = null;
        
        foreach ($xml_values['rss']['channel']['item'] as $article) {
            if ($article['link'] !== 'https://linkhouse.pl/artykul/' . $slug . '/') {
                continue;
            }

            $article = [
                'title' => $article['title'],
                'link' => $article['link'],
                'comments' => $article['comments'],
                'pubDate' => $article['pubDate'],
                'category' => is_array($article['category']) ? $article['category'] : [$article['category']],
                'guid' => $article['guid'],
                'description' => $article['description'],
            ];
        }
        
        if ($article === null) {
            return response()->json([
                'error' => 'Article not found.',
            ], 404);
        } 

        return response()->json($article);
    }
}
