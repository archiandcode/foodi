<?php

namespace App\Modules\Api\Location\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Location\Models\City;
use App\Modules\Api\Location\Resources\CityResource;
use Illuminate\Http\JsonResponse;

class CityController extends Controller
{
    public function index(): JsonResponse
    {
        $id = request()->input('country');
//        $cities = $country->cities()->get();
        $cities = City::query()->where('country_id', '=', $id)->get();
        return response()->json(CityResource::collection($cities));
    }
}
