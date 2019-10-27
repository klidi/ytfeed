<?php
/**
 * Created by IntelliJ IDEA.
 * User: iraklid
 * Date: 17/10/2019
 * Time: 18:41
 */
namespace App\Services\Interfaces;

interface VideoServiceInterface
{
    public function fetchByCountry(string $countryCode);
}
