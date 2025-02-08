<?php

namespace App\Modules\Admin\Location\DTOs;

use Spatie\LaravelData\Data;

class CityData extends Data
{
    public function __construct(
        public string $name,
        public string $latitude,
        public string $longitude,
    ){}
}
