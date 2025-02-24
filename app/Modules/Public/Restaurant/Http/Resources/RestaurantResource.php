<?php

namespace App\Modules\Public\Restaurant\Http\Resources;

use App\Modules\Admin\Restaurants\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Restaurant */
class RestaurantResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'name' => $this->name,
            'description' => $this->description,
            'banner_url' => $this->banner ? asset('storage/' . $this->banner) : null,
            'link' => route('restaurant.dishes', $this->slug)
        ];
    }
}
