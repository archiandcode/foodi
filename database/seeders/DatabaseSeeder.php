<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Admin\Location\Models\Country;
use App\Modules\Admin\Location\Models\City;
use App\Modules\Admin\Restaurants\Models\Restaurant;
use App\Modules\RestaurantPanel\Restaurant\Models\RestaurantAddress;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if (Country::count() === 0 || City::count() === 0) {
            $this->command->warn('Сначала посей таблицы countries и cities.');
            return;
        }

        for ($i = 0; $i < 500; $i++) {
            $country = Country::inRandomOrder()->first();
            $city = City::where('country_id', $country->id)->inRandomOrder()->first();

            if (!$city) {
                continue;
            }

            $name = fake()->unique()->company();
            $restaurant = Restaurant::create([
                'slug' => Str::slug($name) . '-' . Str::random(5),
                'name' => $name,
                'description' => fake()->sentence(),
                'logo' => null,
                'banner' => null,
                'bin' => fake()->numerify('############'),
                'website' => fake()->url(),
                'is_active' => fake()->boolean(90),
                'is_banned' => fake()->boolean(10),
            ]);

            RestaurantAddress::create([
                'restaurant_id' => $restaurant->id,
                'country_id' => $country->id,
                'city_id' => $city->id,
                'address' => fake()->streetAddress(),
                'description' => fake()->optional()->sentence(),
                'latitude' => fake()->latitude(),
                'longitude' => fake()->longitude(),
                'formatted_address' => fake()->address(),
            ]);
        }
    }
}
