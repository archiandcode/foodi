<?php

namespace App\Modules\RestaurantPanel\Restaurant\DTOs;

use App\Modules\Admin\Restaurants\Models\Restaurant;
use Illuminate\Support\Optional;
use Spatie\LaravelData\Data;

class AddressData extends Data
{
    public function __construct(
        public int|null $restaurant_id,
        public int $country_id,
        public int $city_id,
        public string $address,
        public ?string $description = null,
        public string $latitude,
        public string $longitude,
        public string|null $formatted_address,
    ) {}
}
