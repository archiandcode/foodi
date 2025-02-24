<?php

namespace App\Modules\Public\Carts\Contracts;

use App\Modules\Public\Carts\Models\CartItem;
use Illuminate\Database\Eloquent\Collection;

interface CartItemRepoInterface
{
    public function getFirst(int $cartId, int $dishId): CartItem;

    public function getAllByCartId(int $cartId): Collection;
}
