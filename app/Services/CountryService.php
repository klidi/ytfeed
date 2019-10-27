<?php
/**
 * Created by IntelliJ IDEA.
 * User: iraklid
 * Date: 22/10/2019
 * Time: 11:42
 */
namespace App\Services;

use App\Http\Resources\CountryCollection;
use App\Services\Interfaces\CountryServiceInterface;

class CountryService implements CountryServiceInterface
{
    private const DEFAULT_OFFSET = 0;
    private const DEFAULT_LIMIT = 5;

    // we have a simple example but normally this list would be stored in redis or in db
    private $countryList = [
        ['code' => 'gb', 'name' => 'Great Britain',],
        ['code' => 'nl', 'name' => 'Netherlands',],
        ['code' => 'de', 'name' => 'Germany'],
        ['code' => 'fr', 'name' => 'France'],
        ['code' => 'es', 'name' => 'Spain'],
        ['code' => 'it', 'name' => 'Italy'],
        ['code' => 'gr', 'name' => 'Greece'],
    ];

    /**
     * @param array $params
     * @return CountryCollection
     */
    public function fetch(array $params)
    {
        $offset = isset($params['offset']) ? $params['offset'] : self::DEFAULT_OFFSET;
        $limit =  isset($params['limit']) ? $params['limit'] : self::DEFAULT_LIMIT;
        $countries = array_slice($this->countryList, $offset, $limit);
        return new CountryCollection(collect($countries));
    }
}
