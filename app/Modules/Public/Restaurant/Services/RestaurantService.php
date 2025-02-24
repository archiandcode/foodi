<?php

namespace App\Modules\Public\Restaurant\Services;

use App\Modules\Public\Restaurant\Contracts\RestaurantRepoInterface;
use Illuminate\Support\Collection;

class RestaurantService
{
    public function __construct(
        protected RestaurantRepoInterface $restaurantRepo
    ){}

    public function get(int $cityId): Collection
    {
        info($cityId);
        return $this->restaurantRepo->getRestaurantsByCity($cityId);
    }
}
