<?php

namespace App\Modules\Public\Orders\Service;

use App\Modules\Public\Orders\Actions\CreateOrderAction;
use App\Modules\Public\Orders\Actions\CreateOrderItemAction;
use App\Modules\Public\Orders\DTOs\CreateOrderData;
use App\Modules\Shared\Traits\InteractsWithAuthUse;
use Illuminate\Support\Facades\DB;

class OrderService
{
    use InteractsWithAuthUse;

    public function __construct(
        protected CreateOrderAction $createOrderAction,
        protected CreateOrderItemAction $createOrderItemAction
    ) {}

    public function makeOrder(CreateOrderData $data)
    {
        $user = $this->user();
        $data->user_id = $user->id;

        return DB::transaction(function () use ($user, $data) {
            $order = $this->createOrderAction->execute($data);

            foreach ($data->dishes as $item) {
                $this->createOrderItemAction->execute($order, $item);
            }

            return $order;
        });
    }
}
