<?php

namespace App\Modules\Public\Carts\Repositories;

use App\Modules\Admin\Restaurants\Models\Restaurant;
use App\Modules\Public\Carts\Contracts\CartRepoInterface;
use App\Modules\Public\Carts\Models\Cart;
use App\Modules\Users\Models\User;

class CartRepo implements CartRepoInterface
{
    public function getFirstByUser(User $user)
    {
        return Cart::query()->where('user_id', $user->id)->first();
    }

    public function getByRestaurant(User $user, int $restaurantId)
    {
        return Cart::query()->where('user_id', $user->id)
            ->where('restaurant_id', $restaurantId)
            ->first();
    }
}
