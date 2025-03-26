<?php

namespace App\Modules\Public\Carts\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Restaurants\Models\Restaurant;
use App\Modules\Public\Carts\Models\Cart;
use App\Modules\Public\Carts\Models\CartItem;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $cart = Cart::query()->where('user_id', $user->id)->first();
        $cartItems = CartItem::query()->where('cart_id', $cart->id)->with('dish')->get();
        $restaurant = Restaurant::query()->where('id', $cart->restaurant_id)->first();
        return view('public.cart.index', compact('cart', 'cartItems', 'restaurant'));
    }
}
