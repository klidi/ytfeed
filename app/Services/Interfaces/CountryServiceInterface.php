<?php
/**
 * Created by IntelliJ IDEA.
 * User: iraklid
 * Date: 22/10/2019
 * Time: 11:40
 */
namespace App\Services\Interfaces;

interface CountryServiceInterface
{
    /**
     * @param array $params
     * @return mixed
     */
    public function fetch(array $params);
}
