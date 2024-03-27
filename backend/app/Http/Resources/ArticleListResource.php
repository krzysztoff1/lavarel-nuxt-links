<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleListResource extends JsonResource
{
    /**
     * Create a new ArticleListResource instance.
     * 
     * @param  array  $article
     */
    public function __construct($article)
    {
        parent::__construct($article);
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'guid' => $this['guid'],
            'title' => $this['title'],
            'pubDate' => $this['pubDate'],
            'category' => is_array($this['category']) ? $this['category'] : [$this['category']]
        ];
    }
}
