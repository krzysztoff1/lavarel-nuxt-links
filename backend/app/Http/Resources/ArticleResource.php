<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            'link' => $this['link'],
            'description' => $this['description'],
            'category' => is_array($this['category']) ? $this['category'] : [$this['category']]
        ];
    }
}
