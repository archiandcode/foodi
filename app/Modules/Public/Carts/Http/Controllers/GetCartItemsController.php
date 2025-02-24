<?php

namespace App\Modules\Public\Carts\Http\Controllers;

use App\Modules\Admin\Restaurants\Models\Restaurant;
use App\Modules\Public\Carts\Services\CartItemService;
use Illuminate\Http\JsonResponse;

class GetCartItemsController
{
    public function __construct(
        protected CartItemService $service
    ) {}

    public function __invoke(): JsonResponse
    {
        $restaurantId = request()->input('restaurant_id');
        $items = $this->service->getCartItems($restaurantId);
        return response()->json(['items' => $items]);
    }
}
