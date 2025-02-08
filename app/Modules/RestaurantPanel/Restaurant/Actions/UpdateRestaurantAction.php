<?php

namespace App\Modules\RestaurantPanel\Restaurant\Actions;

use App\Modules\RestaurantPanel\Restaurant\DTOs\RestaurantData;
use App\Modules\Admin\Restaurants\Models\Restaurant;
use Illuminate\Http\UploadedFile;

class UpdateRestaurantAction
{
    public function execute(Restaurant $restaurant, RestaurantData $data)
    {
        $restaurant->update([
                'name' => $data->name,
                'description' => $data->description,
                'logo' => is_string($data->logo) ? $data->logo : $restaurant->logo,
                'banner' => is_string($data->banner) ? $data->banner : $restaurant->banner,
                'website' => $data->website,
                'bin' => $data->bin,
            ]
        );
    }
}
