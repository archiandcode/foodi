<?php

namespace App\Modules\RestaurantPanel\Restaurant\Services;

use App\Modules\RestaurantPanel\Restaurant\Actions\CreateDishAction;
use App\Modules\RestaurantPanel\Restaurant\Contracts\DishRepoInterface;
use App\Modules\RestaurantPanel\Restaurant\Contracts\RestaurantRepoInterface;
use App\Modules\RestaurantPanel\Restaurant\DTOs\DishData;
use App\Modules\RestaurantPanel\Restaurant\Models\Dish;
use App\Modules\RestaurantPanel\Restaurant\Traits\HasCurrentRestaurant;
use App\Modules\Shared\Services\StorageService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class DishService
{
    use HasCurrentRestaurant;

    public function __construct(
        protected CreateDishAction $createDishAction,
        RestaurantRepoInterface $restaurantRepo,
        protected DishRepoInterface $dishRepo,
        protected StorageService $storageService,
    ){
        $this->setRestaurantRepo($restaurantRepo);
    }

    public function getDishes(): Collection
    {
        $restaurant = $this->getRestaurant();
        return $this->dishRepo->getAllByRestaurant($restaurant);
    }

    public function store(DishData $data): void
    {
        DB::transaction(function () use ($data) {
            $restaurant = $this->getRestaurant();
            if ($data->image instanceof UploadedFile) {
                $data->image = $this->storageService->store($data->image, 'dishes');
            }
            $this->createDishAction->execute($data, $restaurant);
        });
    }

    public function update(Dish $dish, DishData $data): void
    {
        DB::transaction(function () use ($dish, $data) {
            $restaurant = $this->getRestaurant();
            if ($data->image instanceof UploadedFile) {
                $data->image = $this->storageService->update($data->image, $dish->image, 'dishes');
            }
        });
    }

    public function delete(Dish $dish): void
    {
        DB::transaction(function () use ($dish) {
            $this->storageService->delete($dish->image);
            $dish->delete();
        });
    }
}
