<?php

namespace App\Modules\RestaurantPanel\Orders\Policies;

use App\Modules\RestaurantPanel\Orders\Models\Order;
use App\Modules\StaffUser\Models\StaffUser;

class OrderPolicy
{
    public function view(StaffUser $user, Order $order): bool
    {
        return $user->isOwner($user);
    }

    public function create(StaffUser $user): bool
    {
        return $user->isOwner($user);
    }

    public function update(StaffUser $user, Order $order): bool
    {
        return $user->isOwner($user);
    }

    public function delete(StaffUser $user, Order $order): bool
    {
        return $user->isOwner($user);
    }
}
