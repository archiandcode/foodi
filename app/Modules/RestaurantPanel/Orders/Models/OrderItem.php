<?php

namespace App\Modules\RestaurantPanel\Orders\Models;

use App\Modules\RestaurantPanel\Restaurant\Models\Dish;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $order_id
 * @property int $dish_id
 * @property int $quantity
 * @property float $price
 * @property float $total
 *
 * @property Order $order
 * @property Dish $dish
 */
class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'dish_id',
        'quantity',
        'price',
        'total',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function dish(): BelongsTo
    {
        return $this->belongsTo(Dish::class);
    }
}
