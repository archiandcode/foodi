<?php

namespace App\Modules\RestaurantPanel\Restaurant\Services;

use App\Modules\Admin\Restaurants\Models\Restaurant;
use App\Modules\RestaurantPanel\Restaurant\Actions\UpdateRestaurantAction;
use App\Modules\RestaurantPanel\Restaurant\DTOs\RestaurantData;
use App\Modules\RestaurantPanel\Restaurant\Traits\HasCurrentRestaurant;
use App\Modules\RestaurantPanel\Restaurant\Contracts\RestaurantRepoInterface;
use App\Modules\Shared\Services\StorageService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class RestaurantService
{
    use HasCurrentRestaurant;

    public function __construct(
        RestaurantRepoInterface $restaurantRepo,
        protected StorageService $storageService,
        protected UpdateRestaurantAction $updateRestaurantAction,
    )
    {
        $this->setRestaurantRepo($restaurantRepo);
    }

    public function getCurrentRestaurant(): Restaurant
    {
        return $this->getRestaurant();
    }

    public function update(RestaurantData $data): void
    {
        $restaurant =  $this->getRestaurant();

        DB::transaction(function () use ($restaurant, $data) {
           if ($data->logo instanceof UploadedFile)
           {
               $data->logo = $this->storageService->update($data->logo, $restaurant->logo, 'restaurants/logos');
           }
           if ($data->banner instanceof UploadedFile)
           {
               $data->banner = $this->storageService->update($data->banner, $restaurant->banner, 'restaurants/banners');
           }

           $this->updateRestaurantAction->execute($restaurant, $data);
        });
    }
}
