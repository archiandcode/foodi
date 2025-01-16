<?php

namespace App\Modules\Location\Data;

use Spatie\LaravelData\Data;

class CityData extends Data
{
    public function __construct(
        public string $name,
    ){}
}
