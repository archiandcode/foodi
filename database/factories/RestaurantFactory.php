<?php

namespace Database\Factories;

use App\Modules\Admin\Restaurants\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class RestaurantFactory extends Factory
{
    protected $model = Restaurant::class;

    public function definition(): array
    {
        $name = $this->faker->unique()->company;
        $slug = Str::slug($name) . '-' . Str::random(5);

        return [
            'slug' => $slug,
            'name' => $name,
            'description' => $this->faker->sentence,
            'logo' => null,
            'banner' => null,
            'bin' => $this->faker->numerify('############'),
            'website' => $this->faker->url,
            'is_active' => $this->faker->boolean(90),
            'is_banned' => $this->faker->boolean(10),
        ];
    }
}
