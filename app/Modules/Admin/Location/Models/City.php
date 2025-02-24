<?php

namespace App\Modules\Admin\Location\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property string name
 * @property float $latitude
 * @property float $longitude
 * @property bool $is_default
 */

class City extends Model
{
    protected $fillable = [
        'name',
        'latitude',
        'longitude',
        'is_default',
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
