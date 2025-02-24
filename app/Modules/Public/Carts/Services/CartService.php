<?php

namespace App\Modules\Public\Carts\Services;

use App\Modules\Public\Carts\Actions\CreateCartIfNotExistsAction;
use App\Modules\Public\Carts\Actions\CreateCartItemAction;
use App\Modules\Public\Carts\Actions\DeleteExistingCartAction;
use App\Modules\Public\Carts\Contracts\CartRepoInterface;
use App\Modules\Public\Carts\DTOs\CreateCartData;
use App\Modules\Public\Carts\DTOs\CreateCartItemData;
use App\Modules\RestaurantPanel\Restaurant\Contracts\DishRepoInterface;
use App\Modules\RestaurantPanel\Restaurant\Models\Dish;
use App\Modules\Shared\Traits\InteractsWithAuthUse;
use Illuminate\Support\Facades\DB;

class CartService
{
    use InteractsWithAuthUse;

    public function __construct(
        protected CartRepoInterface           $cartRepo,
        protected CreateCartIfNotExistsAction $createCartAction,
        protected CreateCartItemAction        $createCartItemAction,
        protected DishRepoInterface           $dishRepo,
        protected DeleteExistingCartAction    $deleteExistingCartAction,
    ){}

    public function addDishToCard(int $dishId): Dish
    {
        $user = $this->user();

        $dish = $this->dishRepo->getFirstById($dishId);

        DB::transaction(function () use ($user, $dish) {
            $existingCart = $this->cartRepo->getFirstByUser($user);
            info($existingCart);

            $this->deleteExistingCartAction->execute($existingCart, $dish);

            $cart = $this->createCartAction->execute(CreateCartData::from([
                'user_id' => $user->id,
                'restaurant_id' => $dish->restaurant_id,
            ]));

            info($cart);

            $this->createCartItemAction->execute(CreateCartItemData::from([
                'cart_id' => $cart->id,
                'dish_id' => $dish->id,
            ]));
        });

        return $dish;
    }
}
