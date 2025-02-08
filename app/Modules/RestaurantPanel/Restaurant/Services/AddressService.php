<?php

namespace App\Modules\RestaurantPanel\Restaurant\Services;

use App\Modules\Admin\Restaurants\Models\Restaurant;
use App\Modules\RestaurantPanel\Restaurant\Actions\CreateRestaurantAddressAction;
use App\Modules\RestaurantPanel\Restaurant\Actions\UpdateRestaurantAddressAction;
use App\Modules\RestaurantPanel\Restaurant\DTOs\AddressData;
use App\Modules\RestaurantPanel\Restaurant\Models\RestaurantAddress;
use App\Modules\RestaurantPanel\Restaurant\Repositories\RestaurantRepo;
use App\Modules\RestaurantPanel\Restaurant\Traits\HasCurrentRestaurant;
use App\Modules\Shared\Services\GoogleGeocodingService;

class AddressService
{
    use HasCurrentRestaurant;

    public function __construct(
        RestaurantRepo $restaurantRepo,
        protected CreateRestaurantAddressAction $createAddressAction,
        protected UpdateRestaurantAddressAction $updateAddressAction,
        protected GoogleGeocodingService  $googleAddressService,
    )
    {
        $this->setRestaurantRepo($restaurantRepo);
    }

    public function getCurrentRestaurant(): Restaurant
    {
        return $this->getRestaurant();
    }

    public function store(AddressData $data): void
    {
        $restaurant = $this->getRestaurant();
        $data->restaurant_id = $restaurant->id;
        $data->formatted_address = $this->googleAddressService->getAddressFromCoords($data->latitude, $data->longitude);
        $this->createAddressAction->execute($restaurant, $data);
    }

    public function update(RestaurantAddress $address, AddressData $data): void
    {
        $this->updateAddressAction->execute($address, $data);
    }
}
