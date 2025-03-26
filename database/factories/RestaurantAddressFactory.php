<?php

namespace Database\Factories;

use App\Modules\Admin\Location\Models\City;
use App\Modules\Admin\Location\Models\Country;
use App\Modules\Admin\Restaurants\Models\Restaurant;
use App\Modules\RestaurantPanel\Restaurant\Models\RestaurantAddress;
use Illuminate\Database\Eloquent\Factories\Factory;


class RestaurantAddressFactory extends Factory
{
    public function definition(): array
    {
        $country = Country::query()->inRandomOrder()->first();
        $city = City::query()->inRandomOrder()->where('country_id', $country->id)->first();
        return [
            'restaurant_id' => Restaurant::factory(),
            'country_id' => $country->id,
            'city_id' => $city->id,
            'address' => $this->faker->streetAddress,
            'description' => $this->faker->optional()->sentence,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'formatted_address' => $this->faker->address,
        ];
    }
}
