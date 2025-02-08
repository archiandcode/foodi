<?php

namespace App\Modules\Users\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int user_id
 * @property int latitude
 * @property int longitude
 */
class Address extends Model
{
    protected $fillable = [
        'user_id',
        'latitude',
        'longitude',
    ];
}
