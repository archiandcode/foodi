<?php

namespace App\Modules\Public\Carts\Models;

use App\Modules\RestaurantPanel\Restaurant\Models\Dish;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property int cart_id
 * @property int dish_id
 * @property int quantity
 */
class CartItem extends Model
{
    protected $fillable = [
        'cart_id',
        'dish_id',
        'quantity',
    ];

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function dish(): BelongsTo
    {
        return $this->belongsTo(Dish::class);
    }
}
