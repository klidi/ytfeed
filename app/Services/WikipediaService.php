<?php
/**
 * Created by IntelliJ IDEA.
 * User: iraklid
 * Date: 17/10/2019
 * Time: 17:48
 */
namespace App\Services;

use App\Http\Resources\Country;
use App\Services\Interfaces\WikipediaServiceInterface;

class WikipediaService implements WikipediaServiceInterface
{
    use Traits\GuzzleTrait;

    private const BASE_URL = 'https://en.wikipedia.org/w/api.php';
    private const FORMAT = 'json';
    private const POOL_SIZE = 5;
    private const CACHE_TIME = 86400;

    /**
     * since this services is beeing provided as
     * singleton we are storing the articles fetched from wiki here
     * to not make unnecessary readings from cache (redis)
     */
     private $articles = [];

    /**
     * search for wiki article related to the Country
     *
     * @param array $countries
     */
    public function searchCountryArticle(array $countries): void
    {
        $url = self::BASE_URL;
        $params = [];
        $cacheKeys = [];
        foreach ($countries as $country) {
            $params[] = [
                'action' => 'query',
                'prop' => 'extracts',
                'exintro' => true,
                'explaintext' => true,
                'titles' => $country->resource['name'],
                'format' => self::FORMAT,
            ];
            $cacheKeys[] = "article:" . $country->resource['code'];
        }
        $this->articles = array_merge($this->articles, $this->apiGetAsyncPool($url, $params, $cacheKeys));
    }

    /**
     * This tries to fetch from our private property
     * if the article for country is not found there
     * then tries to fetch it from cache or wiki api
     * by calling searchCountryArticle
     *
     * @param Country $country
     * @return array
     */
    public function fetchByCountry(Country $country) : array
    {
        $key = 'article:' . $country['code'];
        if (!isset($this->articles[$key])) {
            $this->searchCountryArticle([$country]);
        }
        return $this->articles[$key];
    }
}
