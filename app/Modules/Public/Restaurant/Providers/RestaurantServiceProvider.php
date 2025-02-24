<?php

namespace App\Modules\Public\Restaurant\Providers;

use App\Modules\Public\Restaurant\Contracts\RestaurantRepoInterface;
use App\Modules\Public\Restaurant\Repositories\RestaurantRepo;
use Illuminate\Support\ServiceProvider;

class RestaurantServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(RestaurantRepoInterface::class, RestaurantRepo::class);
    }

    public function boot()
    {

    }
}
