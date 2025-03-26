<?php

namespace App\Modules\Public\Orders\Service;

use App\Modules\Public\Carts\Services\CartService;
use App\Modules\Public\Orders\Actions\CreateOrderAction;
use App\Modules\Public\Orders\Actions\CreateOrderAddressAction;
use App\Modules\Public\Orders\Actions\CreateOrderItemAction;
use App\Modules\Public\Orders\DTOs\CreateOrderData;
use App\Modules\RestaurantPanel\Orders\Models\Order;
use App\Modules\Shared\Traits\InteractsWithAuthUse;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class OrderService
{
    use InteractsWithAuthUse;

    public function __construct(
        protected CreateOrderAction $createOrderAction,
        protected CreateOrderItemAction $createOrderItemAction,
        protected CreateOrderAddressAction $createOrderAddressAction,
        protected CartService $cartService,
    ) {}

    public function makeOrder(CreateOrderData $data)
    {
        info($data->address);
        $user = $this->user();
        $data->user_id = $user->id;

        return DB::transaction(function () use ($user, $data) {
            $order = $this->createOrderAction->execute($data);

            foreach ($data->dishes as $item) {
                $this->createOrderItemAction->execute($order, $item);
            }

            $this->createOrderAddressAction->execute($data->address);

            $this->cartService->clear();
            return $order;
        });
    }

    public function getOrders(): Collection
    {
        $user = $this->user();
        return Order::query()->where('user_id', $user->id)->with('restaurant')->get();
    }
}
