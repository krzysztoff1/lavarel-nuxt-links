<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class LinkhouseApiService
{
    const CACHE_KEY_BASE = 'linkhouse_article_list_';

    /**
     * Fetches the feed from the Linkhouse API.
     *
     * @param string $lang
     * @return \Illuminate\Http\Client\Response
     */
    public function fetchFeed($lang)
    {
        $cache_key = self::CACHE_KEY_BASE . $lang;

        if (Cache::has($cache_key)) {
            $response = Cache::get($cache_key);
        } else {
            $url = Config::get("api.linkhouse.{$lang}") . '/feed/';
            $response = Http::get($url);

            if ($response->successful()) {
                Cache::put($cache_key, $response->body(), 60 * 60);
            }
        }

        return $response;
    }
}
