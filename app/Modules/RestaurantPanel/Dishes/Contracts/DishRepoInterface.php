<?php

namespace App\Modules\RestaurantPanel\Dishes\Contracts;

use App\Modules\Admin\Restaurants\Models\Restaurant;
use Illuminate\Database\Eloquent\Collection;

interface DishRepoInterface
{
    public function getAllByRestaurant(Restaurant $restaurant): Collection;
    public function getAllWithFilters(array $filters);
}
