<?php

namespace App\Modules\RestaurantPanel\Restaurant\Actions;

use App\Modules\RestaurantPanel\Restaurant\DTOs\AddressData;
use App\Modules\RestaurantPanel\Restaurant\Models\RestaurantAddress;

class UpdateRestaurantAddressAction
{
    public function execute(RestaurantAddress $address, AddressData $data): void
    {
        $address->update([
            'country_id'  => $data->country_id,
            'city_id'     => $data->city_id,
            'address'     => $data->address,
            'description' => $data->description,
        ]);

    }
}
