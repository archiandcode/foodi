<?php

namespace App\Modules\Admin\Restaurants\Actions;

use App\Modules\Public\RestaurantApplication\Enums\RestaurantApplicationEnum;
use App\Modules\Public\RestaurantApplication\Models\RestaurantApplication;

class ApproveApplicationAction
{
    public function execute(RestaurantApplication $application): void
    {
        $application->status = RestaurantApplicationEnum::Approved;
        $application->save();
    }
}
