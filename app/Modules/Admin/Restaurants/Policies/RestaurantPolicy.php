<?php

namespace App\Modules\Admin\Restaurants\Policies;

use App\Modules\Admin\Restaurants\Models\Restaurant;
use App\Modules\StaffUser\Enums\RolesEnum;
use App\Modules\StaffUser\Models\StaffUser;

class RestaurantPolicy
{
    protected function isAdmin(StaffUser $user): bool
    {
        return $user->role?->name === RolesEnum::Admin->value;
    }

    public function viewAny(StaffUser $user): bool
    {
        return $this->isAdmin($user);
    }

    public function view(StaffUser $user, Restaurant $restaurant): bool
    {
        return $this->isAdmin($user);
    }

    public function update(StaffUser $user, Restaurant $restaurant): bool
    {
        return $this->isAdmin($user);
    }

    public function delete(StaffUser $user, Restaurant $restaurant): bool
    {
        return $this->isAdmin($user);
    }

    public function accept(StaffUser $user, Restaurant $restaurant): bool
    {
        return $this->isAdmin($user);
    }

    public function reject(StaffUser $user, Restaurant $restaurant): bool
    {
        return $this->isAdmin($user);
    }

    public function ban(StaffUser $user, Restaurant $restaurant): bool
    {
        return $this->isAdmin($user);
    }

    public function unban(StaffUser $user, Restaurant $restaurant): bool
    {
        return $this->isAdmin($user);
    }
}
