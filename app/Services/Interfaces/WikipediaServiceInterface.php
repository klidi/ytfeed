<?php
/**
 * Created by IntelliJ IDEA.
 * User: iraklid
 * Date: 17/10/2019
 * Time: 17:48
 */
namespace App\Services\Interfaces;

use App\Http\Resources\Country;

interface WikipediaServiceInterface
{
    public function searchCountryArticle(array $countries);

    public function fetchByCountry(Country $country);
}
