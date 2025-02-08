<?php

namespace App\Modules\RestaurantPanel\Restaurant\DTOs;

use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Data;

class DishData extends Data
{
    public function __construct(
        public string $name,
        public float $price,
        public UploadedFile|string|null $image,
        public bool $is_available = true,
        public int $menu_category_id,
    ){}
}
