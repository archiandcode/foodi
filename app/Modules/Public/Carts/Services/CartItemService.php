<?php

namespace App\Modules\Public\Carts\Services;

use App\Modules\Admin\Restaurants\Models\Restaurant;
use App\Modules\Public\Carts\Contracts\CartItemRepoInterface;
use App\Modules\Public\Carts\Contracts\CartRepoInterface;
use App\Modules\Public\Carts\Models\CartItem;
use App\Modules\Shared\Traits\InteractsWithAuthUse;
use Illuminate\Database\Eloquent\Collection;

class CartItemService
{
    use InteractsWithAuthUse;

    public function __construct(
        protected CartRepoInterface     $cartRepo,
        protected CartItemRepoInterface $careItemRepo,
    ){}

    public function getCartItems(int $restaurantId): Collection|array
    {
        $user = $this->user();
        $cart = $this->cartRepo->getByRestaurant($user, $restaurantId);

        if (!$cart) {
            return [];
        }

        return $this->careItemRepo->getAllByCartId($cart->id);
    }

    public function increment(int $dishId): CartItem
    {
        $user = $this->user();

        $cart = $this->cartRepo->getFirstByUser($user);
        $item = $this->careItemRepo->getFirst($cart->id, $dishId);

        $item->increment('quantity');
        $item->load('dish');

        return $item;
    }

    public function decrement(int $dishId): array
    {
        $user = $this->user();

        $cart = $this->cartRepo->getFirstByUser($user);
        $item = $this->careItemRepo->getFirst($cart->id, $dishId);

        $dish = $item->dish;

        if ($item->quantity > 1) {
            $item->decrement('quantity');
            return [
                'quantity' => $item->quantity,
                'dish' => $dish
            ];
        }

        $item->delete();

        return [
            'quantity' => 0,
            'dish' => $dish
        ];
    }
}
