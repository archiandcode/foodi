<?php

namespace App\Modules\RestaurantPanel\Dishes\Repositories;

use App\Modules\Admin\Restaurants\Models\Restaurant;
use App\Modules\RestaurantPanel\Dishes\Contracts\DishRepoInterface;
use Illuminate\Database\Eloquent\Collection;

class DishRepo implements DishRepoInterface
{
    public function getAllByRestaurant(Restaurant $restaurant): Collection
    {
        return $restaurant->dishes()->get();
    }

    public function getAllWithFilters(array $filters)
    {

    }
}
