<?php

namespace App\Modules\Admin\Location\Actions;

use App\Modules\Admin\Location\DTOs\CityData;
use App\Modules\Admin\Location\Models\Country;

class CreateCityAction
{
    public function execute(Country $country, CityData $data): void
    {
        $country->cities()->create([
            'name' => $data->name,
            'latitude' => $data->latitude,
            'longitude' => $data->longitude,
        ]);
    }
}
