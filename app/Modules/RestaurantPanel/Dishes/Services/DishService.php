<?php

namespace App\Modules\RestaurantPanel\Dishes\Services;

use App\Modules\Admin\Restaurants\Contracts\RestaurantRepoInterface;
use App\Modules\RestaurantPanel\Dishes\Actions\CreateDishAction;
use App\Modules\RestaurantPanel\Dishes\Contracts\DishRepoInterface;
use App\Modules\RestaurantPanel\Dishes\DTOs\DishData;
use App\Modules\RestaurantPanel\Dishes\Traits\HasCurrentRestaurant;
use Illuminate\Database\Eloquent\Collection;

class DishService
{
    use HasCurrentRestaurant;

    public function __construct(
        protected CreateDishAction $createDishAction,
        RestaurantRepoInterface $restaurantRepo,
        protected DishRepoInterface $dishRepo,
    ){
        $this->setRestaurantRepo($restaurantRepo);
    }

    public function getDishes(): Collection
    {
        $restaurant = $this->getRestaurant();
        return $this->dishRepo->getAllByRestaurant($restaurant);
    }

    public function store(array $data): void
    {
        $restaurant = $this->getRestaurant();
        $this->createDishAction->execute(DishData::from($data), $restaurant);
    }
}
