<?php

namespace App\Modules\RestaurantPanel\Restaurant\Actions;

use App\Modules\Admin\Restaurants\Models\Restaurant;
use App\Modules\RestaurantPanel\Restaurant\DTOs\AddressData;

class CreateRestaurantAddressAction
{
    public function execute(Restaurant $restaurant, AddressData $data): void
    {
        $restaurant->addresses()->create([
            'country_id'  => $data->country_id,
            'city_id'     => $data->city_id,
            'address'     => $data->address,
            'description' => $data->description,
            'latitude'    => $data->latitude,
            'longitude'   => $data->longitude,
            'formatted_address' => $data->formatted_address,
        ]);
    }
}
