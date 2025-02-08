<?php

namespace App\Modules\Admin\Location\Actions;

use App\Modules\Admin\Location\DTOs\CountryData;
use App\Modules\Admin\Location\Models\Country;

class CreateCountryAction
{
    public function execute(CountryData $data): void
    {
        Country::query()->create([
            'name' => $data->name,
        ]);
    }
}
