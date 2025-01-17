<?php

namespace App\Modules\RestaurantPanel\Dishes\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property float $price
 * @property string|null $image
 * @property bool $is_available
 * @property int $restaurant_id
 */
class Dish extends Model
{
    protected $fillable = [
        'name',
        'price',
        'image',
        'is_available',
        'restaurant_id',
        'menu_category_id',
    ];
}
