<?php

namespace App\Modules\Admin\Location\Data;

use Dflydev\DotAccessData\Data;

class CountryData extends Data
{
    public function __construct(
        public string $name,
    ){}
}
