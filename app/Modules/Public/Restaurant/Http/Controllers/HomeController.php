<?php

namespace App\Modules\Public\Restaurant\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Restaurants\Models\Restaurant;
use App\Modules\Public\Carts\Models\Cart;
use App\Modules\Public\Carts\Models\CartItem;
use App\Modules\RestaurantPanel\Restaurant\Repositories\MenuCategoryRepo;
use App\Modules\Users\Models\User;

class HomeController extends Controller
{
    public function __construct(
        protected MenuCategoryRepo $menuCategoryRepo,
    ) {}

    public function index()
    {

        return view('public.home.index');
    }

    public function dishes(Restaurant $restaurant)
    {
        $categories = $this->menuCategoryRepo->getMenuCategoriesWithDishes($restaurant);
        /** @var User|null $user */
        $user = auth()->guard('web')->user();
        $cart = null;
        $cartItems = collect([]);;

        if ($user) {
            $cart = Cart::query()
                ->where('user_id', $user->id)
                ->where('restaurant_id', $restaurant->id)
                ->first();

            if ($cart) {
                $cartItems = CartItem::query()
                    ->where('cart_id', $cart->id)
                    ->get()
                    ->keyBy('dish_id');
            }
        }
        return view('public.home.dishes', compact('restaurant', 'categories', 'cart', 'cartItems'));
    }
}
