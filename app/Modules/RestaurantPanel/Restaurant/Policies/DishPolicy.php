<?php

namespace App\Modules\RestaurantPanel\Restaurant\Policies;

use App\Modules\RestaurantPanel\Restaurant\Models\Dish;
use App\Modules\StaffUser\Enums\RolesEnum;
use App\Modules\StaffUser\Models\StaffUser;

class DishPolicy
{
    protected function isOwner(StaffUser $user): bool
    {
        return $user->role?->name === RolesEnum::Owner->value;
    }

    public function view(StaffUser $user, Dish $dish): bool
    {
        return $this->isOwner($user);
    }

    public function create(StaffUser $user): bool
    {
        return $this->isOwner($user);
    }

    public function update(StaffUser $user, Dish $dish): bool
    {
        return $this->isOwner($user);
    }

    public function delete(StaffUser $user, Dish $dish): bool
    {
        return $this->isOwner($user);
    }
}
