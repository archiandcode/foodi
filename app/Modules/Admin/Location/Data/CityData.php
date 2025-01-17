<?php

namespace App\Modules\Admin\Location\Data;

use Spatie\LaravelData\Data;

class CityData extends Data
{
    public function __construct(
        public string $name,
    ){}
}
