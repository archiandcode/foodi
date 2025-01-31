<?php

namespace App\Modules\Admin\Restaurants\Actions;

use App\Modules\Public\RestaurantApplication\Enums\RestaurantApplicationEnum;
use App\Modules\Public\RestaurantApplication\Models\RestaurantApplication;

class RejectApplicationAction
{
    public function execute(RestaurantApplication $application): void
    {
        $application->status = RestaurantApplicationEnum::Rejected;
        $application->save();
    }
}
