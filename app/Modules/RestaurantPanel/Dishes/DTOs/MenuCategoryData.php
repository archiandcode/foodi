<?php

namespace App\Modules\RestaurantPanel\Dishes\DTOs;

use Spatie\LaravelData\Data;

class MenuCategoryData extends Data
{
    public function __construct(
        public string $name,
    ) {}
}
