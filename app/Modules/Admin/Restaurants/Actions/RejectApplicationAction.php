<?php

namespace App\Modules\Admin\Restaurants\Actions;

use App\Modules\Public\Restaurant\Enums\RestaurantApplicationEnum;
use App\Modules\Public\Restaurant\Models\RestaurantApplication;

class RejectApplicationAction
{
    public function execute(RestaurantApplication $application): void
    {
        $application->status = RestaurantApplicationEnum::REJECTED;
        $application->save();
    }
}
