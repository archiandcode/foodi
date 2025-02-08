<?php

namespace App\Modules\RestaurantPanel\Restaurant\Traits;

use App\Modules\Admin\Restaurants\Models\Restaurant;
use App\Modules\RestaurantPanel\Restaurant\Contracts\RestaurantRepoInterface;

trait HasCurrentRestaurant
{
    protected RestaurantRepoInterface $restaurantRepo;

    public function setRestaurantRepo(RestaurantRepoInterface $repo): void
    {
        $this->restaurantRepo = $repo;
    }

    protected function getRestaurant(): Restaurant
    {
        return $this->restaurantRepo->getRestaurantByUser();
    }
}
