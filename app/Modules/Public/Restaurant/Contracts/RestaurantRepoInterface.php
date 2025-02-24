<?php

namespace App\Modules\Public\Restaurant\Contracts;

use Illuminate\Support\Collection;

interface RestaurantRepoInterface
{
    public function getRestaurantsByCity(int $cityId): Collection;
}
