<?php

namespace App\Modules\RestaurantPanel\Dishes\Repositories;

use App\Modules\RestaurantPanel\Dishes\Contracts\MenuCategoryRepoInterface;
use Illuminate\Pagination\LengthAwarePaginator;
class MenuCategoryRepo implements MenuCategoryRepoInterface
{
    public function getMenuCategoriesByRestaurant($restaurant): LengthAwarePaginator
    {
        return $restaurant->categories()->orderBy('id')->paginate(25);
    }
}
