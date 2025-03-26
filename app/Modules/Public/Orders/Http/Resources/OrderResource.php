<?php

namespace App\Modules\Public\Orders\Http\Resources;

use App\Modules\RestaurantPanel\Orders\Models\Order;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Order */
class OrderResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->restaurant->name,
            'status' => $this->status,
            'created_at' => $this->created_at,
        ];
    }
}
