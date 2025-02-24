<?php

namespace App\Modules\Public\Carts\Repositories;

use App\Modules\Public\Carts\Contracts\CartItemRepoInterface;
use App\Modules\Public\Carts\Models\CartItem;
use Illuminate\Database\Eloquent\Collection;

class CartItemRepo implements CartItemRepoInterface
{
    public function getFirst(int $cartId, int $dishId): CartItem
    {
        return CartItem::query()
            ->where('cart_id', $cartId)
            ->where('dish_id', $dishId)
            ->firstOrFail();
    }

    public function getAllByCartId(int $cartId): Collection
    {
        return CartItem::query()
            ->where('cart_id', $cartId)
            ->with('dish')
            ->orderBy('id', 'desc')
            ->get();
    }
}
