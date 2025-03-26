<?php

namespace App\Modules\RestaurantPanel\Orders\Models;

use App\Modules\Admin\Restaurants\Models\Restaurant;
use App\Modules\Users\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $restaurant_id
 * @property int $user_id
 * @property float $total_price
 * @property string status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property OrderItem[]|\Illuminate\Database\Eloquent\Collection $orderItems
 * @property-read \App\Modules\Admin\Restaurants\Models\Restaurant|null $restaurant
 */
class Order extends Model
{
    protected $fillable = [
        'restaurant_id',
        'user_id',
        'total_price',
        'status',
        'order_address_id'
    ];

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
