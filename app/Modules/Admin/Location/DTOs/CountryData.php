<?php

namespace App\Modules\Admin\Location\DTOs;


use Spatie\LaravelData\Data;

class CountryData extends Data
{
    public function __construct(
        public string $name,
        public string $code,
    ){}
}
