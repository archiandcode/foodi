<?php

namespace App\Modules\Public\Restaurant\Models;

use App\Modules\Public\Restaurant\Enums\RestaurantApplicationEnum;
use Database\Factories\RestaurantApplicationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string name
 * @property string owner_name
 * @property string email
 * @property string description
 * @property string status
 * @property string bin
 * @property string website
 */
class RestaurantApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'owner_name',
        'email',
        'phone',
        'description',
        'status',
        'website',
        'bin'
    ];

    protected $casts = [
        'status' => RestaurantApplicationEnum::class
    ];

    public static function newFactory(): RestaurantApplicationFactory
    {
        return RestaurantApplicationFactory::new();
    }
}
