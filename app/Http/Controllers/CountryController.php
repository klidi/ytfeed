<?php
/**
 * Created by IntelliJ IDEA.
 * User: iraklid
 * Date: 17/10/2019
 * Time: 17:24
 */
namespace App\Http\Controllers;

use App\Http\Requests\BaseRequest;
use App\Services\Interfaces\CountryServiceInterface;

class CountryController
{
    /**
     * @param CountryServiceInterface $countryService
     * @param BaseRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getVideos(CountryServiceInterface $countryService, BaseRequest $request)
    {
        $validated = $request->validated();
        return response()->json($countryService->fetch($request->all()));
    }
}
