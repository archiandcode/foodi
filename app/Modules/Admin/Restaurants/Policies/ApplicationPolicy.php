<?php

namespace App\Modules\Admin\Restaurants\Policies;

use App\Modules\StaffUser\Enums\RolesEnum;
use App\Modules\StaffUser\Models\StaffUser;
use App\Modules\Public\RestaurantApplication\Models\RestaurantApplication;

class ApplicationPolicy
{
    protected function isAdmin(StaffUser $user): bool
    {
        return $user->role?->name === RolesEnum::Admin->value;
    }

    public function viewAny(StaffUser $user): bool
    {
        return $this->isAdmin($user);
    }

    public function view(StaffUser $user, RestaurantApplication $application): bool
    {
        return $this->isAdmin($user);
    }

    public function approve(StaffUser $user, RestaurantApplication $application): bool
    {
        return $this->isAdmin($user);
    }

    public function reject(StaffUser $user, RestaurantApplication $application): bool
    {
        return $this->isAdmin($user);
    }
}
