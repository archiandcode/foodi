<?php

namespace App\Modules\Admin\Restaurants\Actions;

use App\Modules\Admin\Restaurants\DTOs\RestaurantData;
use App\Modules\Admin\Restaurants\Models\Restaurant;

class CreateRestaurantAction
{
    public function execute(RestaurantData $data): Restaurant
    {
        return Restaurant::query()->create([
            'name'        => $data->name,
            'description' => $data->description,
            'logo'        => $data->logo,
            'banner'      => $data->banner,
            'is_banned'   => $data->is_banned,
            'website'     => $data->website,
            'bin'         => $data->bin,
        ]);
    }
}
