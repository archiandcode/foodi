<?php

namespace App\Modules\Restaurant\Services;

use App\Modules\Restaurant\Models\Restaurant;

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
