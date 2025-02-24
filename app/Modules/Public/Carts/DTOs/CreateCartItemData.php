<?php

namespace App\Modules\Public\Carts\DTOs;

use Spatie\LaravelData\Data;

class CreateCartItemData extends Data
{
    public function __construct(
        public int $cart_id,
        public int $dish_id,
    ) {}
}
