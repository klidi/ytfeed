<?php
/**
 * Created by IntelliJ IDEA.
 * User: iraklid
 * Date: 17/10/2019
 * Time: 17:46
 */

namespace App\Services;

use App\Facades\AsyncYoutube;

class YoutubeVideoService extends AbstractVideoService
{
    private $maxResults = 10;
    private $part = [
        'snippet'
    ];

    /**
     * Fetch videos from youtube and store them in
     * private property videos
     *
     * @param array $countryCodes
     */
    public function fetchCountryVideosPool(array $countryCodes) : void
    {
        /*
         * there are many ways to fetch the data from external apis in laravel
         * i chose the simplest one by using async request pools in guzzle.
         * in a high demanding app we can use laravel queues
         * (though there is the risk that worker will start leaking memory) so they need monitoring
         * or we can slightly trick php into a different "execution model" similar to nodejs by running an event loop server
         * in front (reactPhp, Swoole, PPM etc)
         */
        $videos = AsyncYoutube::getPopularVideosPool($countryCodes, $this->maxResults, $this->part);
        $this->videos = array_merge($this->videos, $videos);
    }
}
