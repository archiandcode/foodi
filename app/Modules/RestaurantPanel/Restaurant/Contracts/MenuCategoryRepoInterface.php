<?php

namespace App\Modules\RestaurantPanel\Restaurant\Contracts;

use App\Modules\Admin\Restaurants\Models\Restaurant;
use Illuminate\Pagination\LengthAwarePaginator;

interface MenuCategoryRepoInterface
{
    public function getMenuCategoriesByRestaurant(Restaurant $restaurant): LengthAwarePaginator;
}
