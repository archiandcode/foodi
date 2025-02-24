<?php

namespace Database\Factories;

use App\Modules\Public\Restaurant\Enums\RestaurantApplicationEnum;
use App\Modules\Public\Restaurant\Models\RestaurantApplication;
use Illuminate\Database\Eloquent\Factories\Factory;


class RestaurantApplicationFactory extends Factory
{

    protected $model = RestaurantApplication::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'owner_name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'description' => $this->faker->paragraph,
            'status' => RestaurantApplicationEnum::Pending,
            'website' => $this->faker->url,
            'bin' => $this->faker->numerify('###########'),
        ];
    }
}
