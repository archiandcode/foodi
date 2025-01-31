<?php

namespace App\Modules\Admin\Location\Policies;

use App\Modules\StaffUser\Enums\RolesEnum;
use App\Modules\StaffUser\Models\StaffUser;
use App\Modules\Admin\Location\Models\City;

class CityPolicy
{
    protected function isAdmin(StaffUser $user): bool
    {
        return $user->role?->name === RolesEnum::Admin->value;
    }

    public function viewAny(StaffUser $user): bool
    {
        return $this->isAdmin($user);
    }

    public function view(StaffUser $user, City $city): bool
    {
        return $this->isAdmin($user);
    }

    public function create(StaffUser $user): bool
    {
        return $this->isAdmin($user);
    }

    public function update(StaffUser $user, City $city): bool
    {
        return $this->isAdmin($user);
    }

    public function delete(StaffUser $user, City $city): bool
    {
        return $this->isAdmin($user);
    }

}
