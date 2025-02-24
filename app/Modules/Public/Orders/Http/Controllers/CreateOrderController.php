<?php

namespace App\Modules\Public\Orders\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Public\Orders\Http\Requests\CreateOrderRequest;
use App\Modules\Public\Orders\Service\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class CreateOrderController extends Controller
{
    public function __construct(
        protected OrderService $service
    ) {}

    public function __invoke(CreateOrderRequest $request): JsonResponse
    {
        try {
            $this->service->makeOrder($request->getData());

            return response()->json([
                'message' => 'Заказ успешно создан',
            ], 200);
        } catch (\Throwable $e) {
            info('Ошибка при создании заказа', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'message' => 'Ошибка при создании заказа',
                'details' => $e->getMessage(),
            ], 500);
        }
    }
}
