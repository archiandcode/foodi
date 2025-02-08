<?php

namespace App\Modules\Admin\Location\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property string name
 * @property float $latitude
 * @property float $longitude
 */
class City extends Model
{
    protected $fillable = [
        'name',
        'latitude',
        'longitude',
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
