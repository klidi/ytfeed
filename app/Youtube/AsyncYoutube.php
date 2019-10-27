<?php
/**
 * Created by IntelliJ IDEA.
 * User: iraklid
 * Date: 23/10/2019
 * Time: 22:21
 */
namespace App\Youtube;

class AsyncYoutube extends \Alaouy\Youtube\Youtube
{
    use \App\Services\Traits\GuzzleTrait;

    /**
     * number of concurrent pull requests guzzle with send
     * number can be larger but we dont want to many connections opened at same time
     */
    private const POOL_SIZE = 5;

    /**
     * i am setting caching time to 24h, chances that the list changes in 24h are low
     * we could have used carbon to work easier with times and dates and in a real case that would be my choice
     */
    private const CACHE_TIME = 86400;

    public function __construct(string $key)
    {
        parent::__construct($key);
    }

    /**
     * There are many ways to do this but i prefer to keep this simple.
     * Apart from this solution we could go from Laravel queues to event loops but our use case is simple for
     * as long as we have a reasonable upper limit for fetched countries
     *
     * @param array $countries
     * @param int $maxResults
     * @param array $part
     * @return array
     * @throws \Exception
     */
    public function getPopularVideosPool(
        array $countries,
        int $maxResults = 10,
        array $part = [
            'id',
            'snippet',
            'contentDetails',
            'player',
            'statistics',
            'status'
        ]
    ) : array
    {
        $API_URL = $this->getApi('videos.list');
        $cacheKeys = [];
        $params = [];

        foreach ($countries as $country) {
            $params[] = [
                'chart' => 'mostPopular',
                'part' => implode(', ', $part),
                'regionCode' => $country->resource['code'],
                'maxResults' => $maxResults,
                'key' => $this->youtube_key,
            ];
            $cacheKeys[] = "video:" . $country->resource['code'];
        }
        $apiData = $this->apiGetAsyncPool($API_URL, $params, $cacheKeys);
        return $apiData;
    }
}
