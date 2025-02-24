<?php

namespace App\Modules\Public\Restaurant\Http\Controllers;


use App\Modules\Public\Restaurant\Http\Resources\RestaurantResource;
use App\Modules\Public\Restaurant\Services\RestaurantService;
use Illuminate\Http\JsonResponse;

class RestaurantController
{
    public function __construct(
        protected RestaurantService $service
    ) {}

    public function index(): JsonResponse
    {
        $cityId = request()->input('cityId');
        $restaurants = $this->service->get($cityId);

        return response()->json(RestaurantResource::collection($restaurants));
    }
}
