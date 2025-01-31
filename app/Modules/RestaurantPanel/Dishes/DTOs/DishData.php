<?php

namespace App\Modules\RestaurantPanel\Dishes\DTOs;

use Spatie\LaravelData\Data;

class DishData extends Data
{
    public function __construct(
        public string $name,
        public float $price,
        public ?string $image,
        public bool $is_available = true,
        public int $menu_category_id,
    ){}
}
