<?php

namespace App\Modules\Public\Orders\DTOs;

use Spatie\LaravelData\Data;

class OrderAddressData extends Data
{
    public function __construct(
        public ?string $note,
        public float $latitude,
        public float $longitude,
        public int $city_id,
    ) {}
}
