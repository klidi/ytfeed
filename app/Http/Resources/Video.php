<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Video extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) : array
    {
        $snippet = $this->resource['snippet'];
        return [
            'title'       => $snippet['title'],
            'description' => $snippet['description'],
            'thumbnails'  => [
                'default' => $snippet['thumbnails']['default'],
                'high'    => $snippet['thumbnails']['high'],
            ],
        ];
    }
}
