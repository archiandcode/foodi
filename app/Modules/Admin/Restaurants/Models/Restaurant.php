<?php

namespace App\Modules\Admin\Restaurants\Models;

use App\Modules\RestaurantPanel\Dishes\Models\Dish;
use App\Modules\RestaurantPanel\Dishes\Models\MenuCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string name
 * @property string description
 * @property string logo
 * @property string|null banner
 * @property bool is_banned
 * @property bool is_accepted
 */

class Restaurant extends Model
{
    protected $fillable = [
        'name',
        'description',
        'logo',
        'banner',

        'is_banned',
        'is_accepted',
    ];

    public function categories(): HasMany
    {
        return $this->hasMany(MenuCategory::class);
    }

    public function dishes(): HasMany
    {
        return $this->hasMany(Dish::class);
    }

//    public function owner(): BelongsTo
//    {
//        return $this->belongsTo(StaffUser::class);
//    }
}
