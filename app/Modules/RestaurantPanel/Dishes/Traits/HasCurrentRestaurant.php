<?php

namespace App\Modules\RestaurantPanel\Dishes\Traits;

use App\Modules\Admin\Restaurants\Contracts\RestaurantRepoInterface;
use App\Modules\Admin\Restaurants\Models\Restaurant;

trait HasCurrentRestaurant
{
    protected RestaurantRepoInterface $restaurantRepo;

    public function setRestaurantRepo(RestaurantRepoInterface $repo): void
    {
        $this->restaurantRepo = $repo;
    }

    protected function getRestaurant(): Restaurant
    {
        return $this->restaurantRepo->getRestaurantByOwner();
    }
}
