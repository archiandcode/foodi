<?php

namespace App\Providers;

use App\Modules\Admin\Location\Models\City;
use App\Modules\Admin\Location\Models\Country;
use App\Modules\Admin\Location\Policies\CityPolicy;
use App\Modules\Admin\Location\Policies\CountryPolicy;
use App\Modules\Admin\Restaurants\Contracts\ApplicationRepoInterface;
use App\Modules\Admin\Restaurants\Contracts\RestaurantRepoInterface;
use App\Modules\Admin\Restaurants\Repositories\ApplicationRepo;
use App\Modules\Admin\Restaurants\Repositories\RestaurantRepo;
use App\Modules\RestaurantPanel\Dishes\Contracts\DishRepoInterface;
use App\Modules\RestaurantPanel\Dishes\Contracts\MenuCategoryRepoInterface;
use App\Modules\RestaurantPanel\Dishes\Repositories\DishRepo;
use App\Modules\RestaurantPanel\Dishes\Repositories\MenuCategoryRepo;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ApplicationRepoInterface::class, ApplicationRepo::class);
        $this->app->bind(RestaurantRepoInterface::class, RestaurantRepo::class);
        $this->app->bind(MenuCategoryRepoInterface::class, MenuCategoryRepo::class);
        $this->app->bind(DishRepoInterface::class, DishRepo::class);
    }

    public function boot(): void
    {
        Gate::policy(City::class, CityPolicy::class);
        Gate::policy(Country::class, CountryPolicy::class);
    }
}
