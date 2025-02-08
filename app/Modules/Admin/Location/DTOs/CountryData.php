<?php

namespace App\Modules\Admin\Location\DTOs;

use Dflydev\DotAccessData\Data;

class CountryData extends Data
{
    public function __construct(
        public string $name,
    ){}
}
