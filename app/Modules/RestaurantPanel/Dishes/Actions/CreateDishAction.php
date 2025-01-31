<?php

namespace App\Modules\RestaurantPanel\Dishes\Actions;

use App\Modules\Admin\Restaurants\Models\Restaurant;
use App\Modules\RestaurantPanel\Dishes\DTOs\DishData;

class CreateDishAction
{
    public function execute(DishData $data, Restaurant $restaurant): void
    {
        $restaurant->dishes()->create($data->toArray());
    }
}
