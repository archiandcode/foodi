<?php

namespace App\Modules\RestaurantPanel\Orders\Models;

use App\Modules\Admin\Location\Models\City;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property float|null $latitude
 * @property float|null $longitude
 * @property string|null $note
 * @property int city_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class OrderAddress extends Model
{
    protected $fillable = [
        'latitude',
        'longitude',
        'note',
        'city_id'
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
