<?php

namespace App\Modules\Public\Orders\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Public\Orders\Http\Requests\CreateOrderRequest;
use App\Modules\Public\Orders\Http\Resources\OrderResource;
use App\Modules\Public\Orders\Service\OrderService;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    public function __construct(
        protected OrderService $service
    ) {}

    public function json(): JsonResponse
    {
        $orders = $this->service->getOrders();
        return response()->json(OrderResource::collection($orders));
    }

    public function cancel()
    {

    }

    public function store(CreateOrderRequest $request): JsonResponse
    {
        $this->service->makeOrder($request->getData());
        notify()->success('', 'Заказ успешно создан!');
        return response()->json([
            'message' => 'Заказ успешно создан',
        ]);
    }
}
