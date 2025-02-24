<?php

namespace App\Modules\Public\Carts\Actions;

use App\Modules\Public\Carts\Models\Cart;
use App\Modules\RestaurantPanel\Restaurant\Models\Dish;

class DeleteExistingCartAction
{
    public function execute(?Cart $cart, Dish $dish): void
    {
        if ($cart && $cart->restaurant_id !== $dish->restaurant_id) {
            $cart->delete();
        }
    }
}

