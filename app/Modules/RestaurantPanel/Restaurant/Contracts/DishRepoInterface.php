<?php

namespace App\Modules\RestaurantPanel\Restaurant\Contracts;

use App\Modules\Admin\Restaurants\Models\Restaurant;
use App\Modules\RestaurantPanel\Restaurant\Models\Dish;
use Illuminate\Database\Eloquent\Collection;

interface DishRepoInterface
{
    public function getAllByRestaurant(Restaurant $restaurant): Collection;
    public function getAllWithFilters(array $filters);

    public function getFirstById(int $id): Dish;
}
