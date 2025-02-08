<?php

namespace App\Modules\Api\Location\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Location\Models\Country;
use App\Modules\Api\Location\Resources\CountryResource;
use Illuminate\Http\JsonResponse;

class CountryController extends Controller
{
    public function index(): JsonResponse
    {
        $countries = Country::query()->get();
        return response()->json(CountryResource::collection($countries));
    }
}
