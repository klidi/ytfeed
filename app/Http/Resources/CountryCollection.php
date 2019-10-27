<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CountryCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        $this->fetchRelationships();
        return [
            'meta' => [
                // we can put various additional information
                'request'   => $request->all(),
            ],
            'data' => $this->collection
        ];
    }

    private function fetchRelationships() : void
    {
        $videoService = resolve('App\Services\Interfaces\VideoServiceInterface');
        $videoService->fetchCountryVideosPool($this->collection->toArray());

        $wikiService  = resolve('App\Services\Interfaces\WikipediaServiceInterface');
        $wikiService->searchCountryArticle($this->collection->toArray());
    }
}
