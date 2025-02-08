<?php

namespace App\Modules\Admin\Restaurants\Models;

use App\Modules\RestaurantPanel\Restaurant\Models\Dish;
use App\Modules\RestaurantPanel\Restaurant\Models\MenuCategory;
use App\Modules\RestaurantPanel\Restaurant\Models\RestaurantAddress;
use App\Modules\StaffUser\Models\StaffUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int id
 * @property string name
 * @property string|null description
 * @property string|null logo
 * @property string|null banner
 * @property bool is_banned
 * @property bool is_active
 * @property string|null website
 * @property string bin
 */
class Restaurant extends Model
{
    protected $fillable = [
        'name',
        'description',
        'logo',
        'banner',
        'is_banned',
        'website',
        'bin',
        'is_active',
        'restaurant_id'
    ];

    public function categories(): HasMany
    {
        return $this->hasMany(MenuCategory::class);
    }

    public function dishes(): HasMany
    {
        return $this->hasMany(Dish::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(StaffUser::class);
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(RestaurantAddress::class);
    }
}
