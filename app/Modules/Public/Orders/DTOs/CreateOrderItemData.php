<?php

namespace App\Modules\Public\Orders\DTOs;

use Spatie\LaravelData\Data;

class CreateOrderItemData extends Data
{
    public function __construct(
        public int $dish_id,
        public int $quantity,
        public float $price,
        public float $total,
    ) {}
}
