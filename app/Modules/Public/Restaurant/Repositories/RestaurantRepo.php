<?php

namespace App\Modules\Public\Restaurant\Repositories;

use App\Modules\Public\Restaurant\Contracts\RestaurantRepoInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class RestaurantRepo implements RestaurantRepoInterface
{
    public function getRestaurantsByCity(int $cityId): Collection
    {
        return DB::table('restaurants')
            ->join('restaurant_addresses', 'restaurants.id', '=', 'restaurant_addresses.restaurant_id')
            ->where('restaurant_addresses.city_id', $cityId)
            ->select('restaurants.*')
            ->distinct()
            ->get();
    }

}
