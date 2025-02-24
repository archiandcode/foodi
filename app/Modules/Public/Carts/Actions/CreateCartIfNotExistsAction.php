<?php

namespace App\Modules\Public\Carts\Actions;

use App\Modules\Public\Carts\DTOs\CreateCartData;
use App\Modules\Public\Carts\Models\Cart;

class CreateCartIfNotExistsAction
{
    public function execute(CreateCartData $data)
    {
        return Cart::query()->firstOrCreate([
            'user_id' => $data->user_id,
            'restaurant_id' => $data->restaurant_id,
        ]);
    }
}
