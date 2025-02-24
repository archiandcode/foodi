<?php

namespace App\Modules\Public\Carts\Contracts;

use App\Modules\Admin\Restaurants\Models\Restaurant;
use App\Modules\Users\Models\User;

interface CartRepoInterface
{
    public function getFirstByUser(User $user);
    public function getByRestaurant(User $user, int $restaurantId);

}
