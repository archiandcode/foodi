<?php

namespace App\Modules\Admin\Location\Actions;

use App\Modules\Admin\Location\Models\City;

class UnsetDefaultCityAction
{
    public function execute(?City $city): void
    {
        if ($city) {
            $city->is_default = false;
            $city->save();
        }
    }
}
