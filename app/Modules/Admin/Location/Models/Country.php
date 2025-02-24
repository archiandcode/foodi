<?php

namespace App\Modules\Admin\Location\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int id
 * @property string name
 * @property string code
 */
class Country extends Model
{
    protected $fillable = [
        'name',
        'code',
    ];

    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }
}
