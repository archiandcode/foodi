<?php

namespace App\Modules\Admin\Location\Contracts;

use App\Modules\Admin\Location\Models\Country;

interface CityRepoInterface
{
    public function getDefaultCity(Country $country);
}
