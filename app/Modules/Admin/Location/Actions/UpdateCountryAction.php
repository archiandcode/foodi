<?php

namespace App\Modules\Admin\Location\Actions;

use App\Modules\Admin\Location\DTOs\CountryData;
use App\Modules\Admin\Location\Models\Country;

class UpdateCountryAction
{
    public function execute(Country $country, CountryData $data): void
    {
        $country->update([
            'name' => $data->name,
        ]);
    }
}
