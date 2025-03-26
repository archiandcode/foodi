<?php

namespace App\Modules\Public\Restaurant\Http\Controllers;


use App\Modules\Admin\Restaurants\Models\Restaurant;
use App\Modules\Public\Carts\Models\Cart;
use App\Modules\Public\Carts\Models\CartItem;
use App\Modules\Public\Restaurant\Http\Resources\RestaurantResource;
use App\Modules\Public\Restaurant\Services\RestaurantService;
use App\Modules\RestaurantPanel\Restaurant\Repositories\MenuCategoryRepo;
use App\Modules\Users\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class RestaurantController
{
    public function __construct(
        protected RestaurantService $service,
        protected MenuCategoryRepo $menuCategoryRepo,
    ) {}

    public function json(): JsonResponse
    {
        $cityId = request()->input('cityId');
        $restaurants = $this->service->get($cityId);

        return response()->json(RestaurantResource::collection($restaurants));
    }

    public function index(): View
    {
        return view('public.restaurants.index');
    }

    public function show(Restaurant $restaurant)
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
        return view('public.restaurants.show', compact('restaurant', 'categories', 'cart', 'cartItems'));
    }
}
