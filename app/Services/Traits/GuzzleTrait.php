<?php
/**
 * Created by IntelliJ IDEA.
 * User: iraklid
 * Date: 24/10/2019
 * Time: 18:01
 */

namespace App\Services\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Promise\EachPromise;
use Illuminate\Support\Facades\Cache;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Promise\FulfilledPromise;

trait GuzzleTrait
{
    /**
     * @param string $url
     * @param array $params
     * @param array $cacheKeys
     * @return array
     */
    private function apiGetAsyncPool(string $url, array $params, array $cacheKeys) : array
    {
        $promises = $this->getPromises($url, $params, $cacheKeys);
        $contents = [];

        (new EachPromise($promises, [
            'concurrency' => self::POOL_SIZE,
            'fulfilled' => function ($content) use (&$contents) {
                $contents[$content['key']] = $content['data'];
            },
        ]))->promise()->wait(true);
        return $contents;
    }

    /**
     * @param string $API_URL
     * @param array $params
     * @param array $cacheKeys
     * @return \Generator|null
     */
    private function getPromises(string $API_URL, array $params, array $cacheKeys) :?\Generator
    {
        $client = new Client();
        foreach ($params as $key => $value) {
            $cacheKey = $cacheKeys[$key];
            if (Cache::has($cacheKey)) {
                $cacheData['data'] = Cache::get($cacheKey);
                $cacheData['key'] = $cacheKey;
                yield new FulfilledPromise($cacheData);
                continue;
            } else {
                $options['query'] = $value;
                yield $client->requestAsync('GET', $API_URL, $options)
                    ->then(function (ResponseInterface $response) use ($cacheKey) {
                        $content['data'] = json_decode($response->getBody(), true);
                        $content['key'] = $cacheKey;
                        Cache::put($cacheKey, $content['data'], self::CACHE_TIME);
                        return $content;
                    });
            }
        }
    }
}
