<?php

namespace App\Modules\Public\Carts\Actions;

use App\Modules\Public\Carts\DTOs\CreateCartItemData;
use App\Modules\Public\Carts\Models\CartItem;

class CreateCartItemAction
{
    public function execute(CreateCartItemData $data): void
    {
        CartItem::query()->firstOrCreate(
            [
             'cart_id' => $data->cart_id,
             'dish_id' => $data->dish_id,
            ],
            ['quantity' => 1]
        );
    }
}
