<?php

namespace App\Modules\RestaurantPanel\Restaurant\Policies;

use App\Modules\RestaurantPanel\Restaurant\Models\Dish;
use App\Modules\StaffUser\Models\StaffUser;

class DishPolicy
{
    public function viewAny(StaffUser $user): bool
    {
        return $user->isOwner();
    }

    public function view(StaffUser $user, Dish $dish): bool
    {
        return $user->isOwner();
    }

    public function create(StaffUser $user): bool
    {
        return $user->isOwner();
    }

    public function update(StaffUser $user, Dish $dish): bool
    {
        return $user->isOwner();
    }

    public function delete(StaffUser $user, Dish $dish): bool
    {
        return $user->isOwner();
    }
}
