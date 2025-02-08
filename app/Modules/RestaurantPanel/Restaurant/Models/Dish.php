<?php

namespace App\Modules\RestaurantPanel\Restaurant\Models;

use App\Modules\Admin\Restaurants\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $name
 * @property float $price
 * @property string|null $image
 * @property bool $is_available
 * @property int $restaurant_id
 * @property int $menu_category_id
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

    protected $casts = [
        'is_available' => 'boolean',
        'price' => 'float',
    ];

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function menuCategory(): BelongsTo
    {
        return $this->belongsTo(MenuCategory::class);
    }
}
