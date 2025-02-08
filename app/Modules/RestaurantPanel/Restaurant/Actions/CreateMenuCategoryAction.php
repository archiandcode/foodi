<?php

namespace App\Modules\RestaurantPanel\Restaurant\Actions;

use App\Modules\Admin\Restaurants\Models\Restaurant;
use App\Modules\RestaurantPanel\Restaurant\DTOs\MenuCategoryData;

class CreateMenuCategoryAction
{
    public function execute(Restaurant $restaurant, MenuCategoryData $data): void
    {
        $restaurant->categories()->create($data->toArray());
    }
}
