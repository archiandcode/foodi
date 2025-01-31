<?php

namespace App\Modules\Admin\Restaurants\Repositories;

use App\Modules\Admin\Restaurants\Contracts\RestaurantRepoInterface;
use App\Modules\Admin\Restaurants\Models\Restaurant;
use App\Modules\StaffUser\Models\StaffUser;

class RestaurantRepo implements RestaurantRepoInterface
{
    function getRestaurantByOwner(): Restaurant
    {
        /** @var StaffUser $user */
        $user = auth()->guard('staff')->user();

        return Restaurant::query()
            ->where('owner_id', $user->id)
            ->firstOrFail();
    }
}
