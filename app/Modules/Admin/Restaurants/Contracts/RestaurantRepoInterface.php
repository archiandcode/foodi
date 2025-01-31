<?php

namespace App\Modules\Admin\Restaurants\Contracts;

use App\Modules\Admin\Restaurants\Models\Restaurant;

interface RestaurantRepoInterface
{
    function getRestaurantByOwner(): Restaurant;
}
