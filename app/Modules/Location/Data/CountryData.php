<?php

namespace App\Modules\Location\Data;

use Dflydev\DotAccessData\Data;

class CountryData extends Data
{
    public function __construct(
        public string $name,
    ){}
}
