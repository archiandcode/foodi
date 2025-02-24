<?php

namespace App\Modules\Public\Orders\Actions;

use App\Modules\Public\Orders\DTOs\CreateOrderData;
use App\Modules\RestaurantPanel\Orders\Models\Order;

class CreateOrderAction
{
    public function execute(CreateOrderData $data)
    {
        return Order::query()->create([
            'user_id' => $data->user_id,
            'restaurant_id' => $data->restaurant_id,
        ]);
    }
}
