<?php

namespace App\Modules\Admin\Location\Repositories;

use App\Modules\Admin\Location\Contracts\CityRepoInterface;
use App\Modules\Admin\Location\Models\Country;

class CityRepo implements CityRepoInterface
{
    public function getDefaultCity(Country $country)
    {
        return $country->cities()->where('is_default', true)->first();
    }
}
