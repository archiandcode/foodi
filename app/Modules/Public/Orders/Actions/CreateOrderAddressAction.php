<?php

namespace App\Modules\Public\Orders\Actions;

use App\Modules\Public\Orders\DTOs\OrderAddressData;
use App\Modules\RestaurantPanel\Orders\Models\OrderAddress;

class CreateOrderAddressAction
{
    public function execute(OrderAddressData $data): void
    {
        OrderAddress::query()->create([
            'latitude' => $data->latitude,
            'longitude' => $data->longitude,
            'note' => $data->note,
            'city_id' => $data->city_id
        ]);
    }
}
