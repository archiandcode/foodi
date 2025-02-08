<?php

namespace App\Modules\RestaurantPanel\Restaurant\Models;

use App\Modules\Admin\Location\Models\City;
use App\Modules\Admin\Location\Models\Country;
use App\Modules\Admin\Restaurants\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
* @property int $id
* @property int $restaurant_id
* @property int $country_id
* @property int $city_id
* @property string|null $address
* @property float $latitude
* @property float $longitude
* @property string|null $place_id
* @property string|null $description
* @property string|null $formatted_address
*/
class RestaurantAddress extends Model
{
    protected $fillable = [
        'restaurant_id',
        'country_id',
        'city_id',
        'address',
        'description',
        'latitude',
        'longitude',
        'formatted_address',
    ];

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
