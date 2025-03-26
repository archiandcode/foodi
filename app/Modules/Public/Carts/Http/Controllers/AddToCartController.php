<?php

namespace App\Modules\Public\Carts\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Public\Carts\Http\Requests\AddToCartRequest;
use App\Modules\Public\Carts\Services\CartItemService;
use App\Modules\Public\Carts\Services\CartService;
use Illuminate\Http\JsonResponse;
use Throwable;

class AddToCartController extends Controller
{
    public function __construct(
        protected CartService $service,
        protected CartItemService $cartItemService,
    ) {}

    public function add(AddToCartRequest $request): JsonResponse
    {
        $dish = $this->service->addDishToCard($request->input('dish_id'));

        return response()->json([
            'success' => true,
            'dish' => $dish,
            'quantity' => 1
        ]);
    }

    public function increment(AddToCartRequest $request): JsonResponse
    {
       $item = $this->cartItemService->increment($request->dish_id);

       return response()->json([
        'success' => true,
        'quantity' => $item->quantity,
        'dish' => $item->dish,
    ]);
    }

    public function decrement(AddToCartRequest $request): JsonResponse
    {
        $result = $this->cartItemService->decrement($request->dish_id);

        return response()->json([
            'success' => true,
            'quantity' => $result['quantity'],
            'dish' => $result['dish']
        ]);
    }

    public function clear(): JsonResponse
    {
        $this->service->clear();
        return response()->json([
            'success' => true,
        ]);
    }
}
