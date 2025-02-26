<?php

namespace App\Modules\RestaurantPanel\Restaurant\Policies;

use App\Modules\RestaurantPanel\Restaurant\Models\MenuCategory;
use App\Modules\StaffUser\Models\StaffUser;

class MenuCategoryPolicy
{
    public function viewAny(StaffUser $user): bool
    {
        return $user->isOwner();
    }

    public function view(StaffUser $user, MenuCategory $menuCategory): bool
    {
        return $user->isOwner();
    }

    public function create(StaffUser $user): bool
    {
        return $user->isOwner();
    }

    public function update(StaffUser $user, MenuCategory $menuCategory): bool
    {
        return $user->isOwner();
    }

    public function delete(StaffUser $user, MenuCategory $menuCategory): bool
    {
        return $user->isOwner();
    }


}
