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
 * @property string slug
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
        'slug',
        'name', 'description',
        'logo', 'banner',
        'bin', 'website',
        'is_active', 'is_banned',
    ];

    protected $appends = ['link', 'banner_url'];

    public function getLinkAttribute(): string
    {
        return route('restaurant.dishes', ['restaurant' => $this->slug]);
    }

    public function getBannerUrlAttribute(): string
    {
        $path = $this->banner;

        return $path
            ? asset('storage/' . $path)
            : "https://img.freepik.com/premium-vector/default-image-icon-vector-missing-picture-page-website-design-mobile-app-no-photo-available_87543-11093.jpg";
    }


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

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
