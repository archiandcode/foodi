<?php

namespace App\Modules\Public\Carts\DTOs;

use Spatie\LaravelData\Data;

class AddToCardData extends Data
{
    public function __construct(
        public int $dish_id
    ) {}
}
