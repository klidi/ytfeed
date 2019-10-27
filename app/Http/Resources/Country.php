<?php

namespace App\Http\Resources;

use App\Services\Interfaces\VideoServiceInterface;
use App\Services\YoutubeVideoService;
use Illuminate\Http\Resources\Json\JsonResource;

class Country extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'code'        => $this->resource['code'],
            'name'        => $this->resource['name'],
            'description' => $this->withArticleDescription($this),
            'videos'  => Video::collection(collect($this->withVideos($this->resource['code']))),
        ];
    }

    /**
     * @param $countryCode
     * @return array
     */
    public function withVideos($countryCode) : array
    {
        $videoService = resolve('App\Services\Interfaces\VideoServiceInterface');
        return $videoService->fetchByCountry($countryCode);
    }

    /**
     * @param $country
     * @return mixed
     */
    public function withArticleDescription($country) : string
    {
        $wikiService  = resolve('App\Services\Interfaces\WikipediaServiceInterface');
        $article = reset($wikiService->fetchByCountry($country)['query']['pages']);
        if (isset($article['extract'])) {
            return $article['extract'];
        }
        return 'Dummmy string to say description not available';
    }
}
