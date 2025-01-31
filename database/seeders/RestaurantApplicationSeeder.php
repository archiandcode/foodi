<?php

namespace Database\Seeders;

use App\Modules\Public\RestaurantApplication\Models\RestaurantApplication;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RestaurantApplication::factory(100)->create();
    }
}
