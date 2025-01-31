<?php

namespace App\Modules\StaffUser\Models;

use App\Modules\Admin\Restaurants\Models\Restaurant;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property int id
 * @property string name
 * @property string email
 * @property string password
 * @property string temp_password
 * @property int|null restaurant_id
 * @property-read Role|null $role
 */

class StaffUser extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'temp_password',
        'restaurant_id',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
}
