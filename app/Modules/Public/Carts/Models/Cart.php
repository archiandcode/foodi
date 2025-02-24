<?php

namespace App\Modules\Public\Carts\Models;

use App\Modules\Users\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property int user_id
 * @property int restaurant_id
 */

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'restaurant_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
