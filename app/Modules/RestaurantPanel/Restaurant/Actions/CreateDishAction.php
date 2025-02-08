<?php

namespace App\Modules\RestaurantPanel\Restaurant\Actions;

use App\Modules\Admin\Restaurants\Models\Restaurant;
use App\Modules\RestaurantPanel\Restaurant\DTOs\DishData;

class CreateDishAction
{
    public function execute(DishData $data, Restaurant $restaurant): void
    {
        $restaurant->dishes()->create([
            'name' => $data->name,
            'price' => $data->price,
            'image' => is_string($data->image) ? $data->image : null,
            'is_available' => $data->is_available,
            'menu_category_id' => $data->menu_category_id,
        ])->toArray();

    }
}
