<?php
/**
 * Created by IntelliJ IDEA.
 * User: iraklid
 * Date: 17/10/2019
 * Time: 18:40
 */
namespace App\Services;

use App\Services\Interfaces\VideoServiceInterface;

abstract class AbstractVideoService implements VideoServiceInterface
{
    /**
     * @var array
     */
    protected $videos = [];

    /**
     * tries to fetch country videos from private property
     * if not tries to fetch them from cache or youtube client
     * by calling fetchCountryVideosPool
     *
     * @param string $countryCode
     * @return array
     */
    public function fetchByCountry(string $countryCode) : array
    {
        $key = 'video:' . $countryCode;
        if (!isset($this->videos[$key])) {
            $this->fetchCountryVideosPool([$countryCode]);
        }
        return $this->videos[$key]['items'];
    }

    abstract public function fetchCountryVideosPool(array $countryCodes);
}
