<?php

namespace App\Modules\Admin\Location\Actions;

use App\Modules\Admin\Location\DTOs\CityData;
use App\Modules\Admin\Location\Models\City;

class UpdateCityAction
{
    public function execute(City $city, CityData $data): void
    {
        $city->update([
            'name' => $data->name,
            'latitude' => $data->latitude,
            'longitude' => $data->longitude,
        ]);
    }
}
