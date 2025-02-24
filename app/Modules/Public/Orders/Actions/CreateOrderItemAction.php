<?php

namespace App\Modules\Public\Orders\Actions;

use App\Modules\Public\Orders\DTOs\CreateOrderItemData;
use App\Modules\RestaurantPanel\Orders\Models\Order;

class CreateOrderItemAction
{
    public function execute(Order $order, CreateOrderItemData $data): void
    {
        $order->orderItems()->create([
            'dish_id' => $data->dish_id,
            'quantity' => $data->quantity,
            'price' => $data->price,
            'total' => $data->total
        ]);
    }
}
