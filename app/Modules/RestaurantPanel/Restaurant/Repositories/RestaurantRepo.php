<?php

namespace App\Modules\RestaurantPanel\Restaurant\Repositories;

use App\Modules\Admin\Restaurants\Models\Restaurant;
use App\Modules\RestaurantPanel\Restaurant\Contracts\RestaurantRepoInterface;
use App\Modules\StaffUser\Models\StaffUser;

class RestaurantRepo implements RestaurantRepoInterface
{
    function getRestaurantByUser(): Restaurant
    {
        /** @var StaffUser $user */
        $user = auth()->guard('staff')->user();

        return $user->restaurant()->firstOrFail();
    }
}
