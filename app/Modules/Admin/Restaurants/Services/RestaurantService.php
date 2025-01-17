<?php

namespace App\Modules\Admin\Restaurants\Services;

use App\Modules\Admin\Restaurants\Models\Restaurant;

class RestaurantService
{
    public function accept(Restaurant $restaurant): void
    {
        $restaurant->update([
            'status' => 'accepted',
        ]);
    }

    public function reject(Restaurant $restaurant): void
    {
        $restaurant->update([
            'status' => 'rejected',
        ]);
    }

    public function ban(Restaurant $restaurant): void
    {
        $restaurant->update([
            'status' => 'banned',
        ]);
    }
}
