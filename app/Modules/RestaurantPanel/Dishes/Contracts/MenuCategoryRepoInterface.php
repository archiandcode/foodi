<?php

namespace App\Modules\RestaurantPanel\Dishes\Contracts;

use App\Modules\Admin\Restaurants\Models\Restaurant;
use Illuminate\Pagination\LengthAwarePaginator;

interface MenuCategoryRepoInterface
{
    public function getMenuCategoriesByRestaurant(Restaurant $restaurant): LengthAwarePaginator;
}
