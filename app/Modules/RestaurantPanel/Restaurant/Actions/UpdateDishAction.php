<?php

namespace App\Modules\RestaurantPanel\Restaurant\Actions;

use App\Modules\RestaurantPanel\Restaurant\DTOs\DishData;
use App\Modules\RestaurantPanel\Restaurant\Models\Dish;

class UpdateDishAction
{
    public function execute(Dish $dish, DishData $data): void
    {
        $dish->update([
            'name' => $data->name,
            'price' => $data->price,
            'image' => is_string($data->image) ? $data->image : $dish->image,
            'is_available' => $data->is_available,
            'menu_category_id' => $data->menu_category_id,
        ]);
    }
}
