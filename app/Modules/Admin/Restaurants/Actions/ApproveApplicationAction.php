<?php

namespace App\Modules\Admin\Restaurants\Actions;

use App\Modules\Public\Restaurant\Enums\RestaurantApplicationEnum;
use App\Modules\Public\Restaurant\Models\RestaurantApplication;

class ApproveApplicationAction
{
    public function execute(RestaurantApplication $application): void
    {
        $application->status = RestaurantApplicationEnum::Approved;
        $application->save();
    }
}
