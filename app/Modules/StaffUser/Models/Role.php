<?php

namespace App\Modules\StaffUser\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $name
 */
class Role extends Model
{
    protected $fillable = [
        'name',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(StaffUser::class);
    }
}
