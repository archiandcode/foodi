<?php

namespace App\Modules\RestaurantPanel\Restaurant\Contracts;

use App\Modules\Admin\Restaurants\Models\Restaurant;

interface RestaurantRepoInterface
{
    function getRestaurantByUser(): Restaurant;
}
