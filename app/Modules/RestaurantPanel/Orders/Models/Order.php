<?php

namespace App\Modules\RestaurantPanel\Orders\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $restaurant_id
 * @property int $user_id
 * @property float $total_price
 *
 * @property OrderItem[]|\Illuminate\Database\Eloquent\Collection $orderItems
 */
class Order extends Model
{
    protected $fillable = [
        'restaurant_id',
        'user_id',
        'total_price',
    ];

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
