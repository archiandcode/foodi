<?php

namespace App\Modules\RestaurantPanel\Restaurant\Policies;

use App\Modules\RestaurantPanel\Restaurant\Models\RestaurantAddress;
use App\Modules\StaffUser\Models\StaffUser;

class AddressPolicy
{
    public function viewAny(StaffUser $user): bool
    {
        return $user->isOwner();
    }

    public function view(StaffUser $user, RestaurantAddress $address): bool
    {
        return $user->isOwner();
    }

    public function create(StaffUser $user): bool
    {
        return $user->isOwner();
    }

    public function update(StaffUser $user, RestaurantAddress $address): bool
    {
        return $user->isOwner();
    }

    public function delete(StaffUser $user, RestaurantAddress $address): bool
    {
        return $user->isOwner();
    }
}
