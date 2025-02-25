<?php

namespace App\Modules\Public\Location\Http\Controllers;

use App\Modules\Admin\Location\Models\City;
use App\Modules\Admin\Location\Models\Country;
use App\Modules\Public\Location\Http\Resources\CityResource;
use App\Modules\Public\Location\Http\Resources\CountryResource;
use App\Modules\Public\Location\Services\LocationService;
use Illuminate\Http\JsonResponse;

class LocationController
{
    public function __construct(
        protected LocationService $service,
    ){}

    public function getCountries(): JsonResponse
    {
        $countries = $this->service->getCountries();
        return response()->json(CountryResource::collection($countries));
    }

    public function getCities(): JsonResponse
    {
        $id = request()->input('country');
        $cities = $this->service->getCities($id);
        return response()->json(CityResource::collection($cities));
    }
}
