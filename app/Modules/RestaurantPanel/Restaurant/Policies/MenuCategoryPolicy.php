<?php

namespace App\Modules\RestaurantPanel\Restaurant\Policies;

use App\Modules\RestaurantPanel\Restaurant\Models\MenuCategory;
use App\Modules\StaffUser\Enums\RolesEnum;
use App\Modules\StaffUser\Models\StaffUser;

class MenuCategoryPolicy
{
    protected function isOwner(StaffUser $user): bool
    {
        return $user->role?->name === RolesEnum::Owner->value;
    }

    public function viewAny(StaffUser $user): bool
    {
        return $this->isOwner($user);
    }

    public function view(StaffUser $user, MenuCategory $menuCategory): bool
    {
        return $this->isOwner($user);
    }

    public function create(StaffUser $user): bool
    {
        return $this->isOwner($user);
    }

    public function update(StaffUser $user, MenuCategory $menuCategory): bool
    {
        return $this->isOwner($user);
    }

    public function delete(StaffUser $user, MenuCategory $menuCategory): bool
    {
        return $this->isOwner($user);
    }


}
