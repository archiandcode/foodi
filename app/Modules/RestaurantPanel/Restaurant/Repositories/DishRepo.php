<?php

namespace App\Modules\RestaurantPanel\Restaurant\Repositories;

use App\Modules\Admin\Restaurants\Models\Restaurant;
use App\Modules\RestaurantPanel\Restaurant\Contracts\DishRepoInterface;
use App\Modules\RestaurantPanel\Restaurant\Models\Dish;
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

    public function getFirstById(int $id): Dish
    {
        return Dish::query()->findOrFail($id);
    }
}
