<?php

namespace App\Modules\Restaurant\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string name
 * @property string description
 * @property string logo
 * @property string|null banner
 * @property bool is_banned
 * @property bool is_accepted
 */

class Restaurant extends Model
{
    protected $fillable = [
        'name',
        'description',
        'logo',
        'banner',

        'is_banned',
        'is_accepted',
    ];

//    public function owner(): BelongsTo
//    {
//        return $this->belongsTo(StaffUser::class);
//    }
}
