<?php

namespace App\Modules\Public\Carts\DTOs;

use Spatie\LaravelData\Data;

class CreateCartData extends Data
{
    public function __construct(
       public int $user_id,
       public int $restaurant_id,
    ) {}
}
