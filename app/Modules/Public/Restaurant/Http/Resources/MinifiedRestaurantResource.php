<?php

namespace App\Modules\Public\Restaurant\Http\Resources;

use App\Modules\Admin\Restaurants\Models\Restaurant;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Restaurant */
class MinifiedRestaurantResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
