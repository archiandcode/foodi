<?php

namespace App\Modules\RestaurantPanel\Restaurant\Repositories;

use App\Modules\Admin\Restaurants\Models\Restaurant;
use App\Modules\RestaurantPanel\Restaurant\Contracts\MenuCategoryRepoInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
class MenuCategoryRepo implements MenuCategoryRepoInterface
{
    public function getMenuCategoriesByRestaurant($restaurant): LengthAwarePaginator
    {
        return $restaurant->categories()->orderBy('id')->paginate(25);
    }

    public function getMenuCategoriesWithDishes(Restaurant $restaurant): Collection
    {
        return $restaurant->categories()
        ->whereHas('dishes')
        ->with('dishes')
        ->get();
    }
}
