<?php

namespace App\Modules\RestaurantPanel\Dishes\Actions;

use App\Modules\Admin\Restaurants\Models\Restaurant;
use App\Modules\RestaurantPanel\Dishes\DTOs\MenuCategoryData;

class CreateMenuCategoryAction
{
    public function execute(Restaurant $restaurant, MenuCategoryData $data): void
    {
        $restaurant->categories()->create($data->toArray());
    }
}
