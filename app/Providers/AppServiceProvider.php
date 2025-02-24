<?php

namespace App\Providers;

use App\Modules\Admin\Location\Models\City;
use App\Modules\Admin\Location\Models\Country;
use App\Modules\Admin\Location\Policies\CityPolicy;
use App\Modules\Admin\Location\Policies\CountryPolicy;
use App\Modules\Admin\Restaurants\Contracts\ApplicationRepoInterface;
use App\Modules\Admin\Restaurants\Models\Restaurant;
use App\Modules\Admin\Restaurants\Policies\ApplicationPolicy;
use App\Modules\Admin\Restaurants\Policies\RestaurantPolicy;
use App\Modules\Admin\Restaurants\Repositories\ApplicationRepo;
use App\Modules\Public\Restaurant\Models\RestaurantApplication;
use App\Modules\RestaurantPanel\Restaurant\Contracts\DishRepoInterface;
use App\Modules\RestaurantPanel\Restaurant\Contracts\MenuCategoryRepoInterface;
use App\Modules\RestaurantPanel\Restaurant\Repositories\DishRepo;
use App\Modules\RestaurantPanel\Restaurant\Repositories\MenuCategoryRepo;
use App\Modules\RestaurantPanel\Restaurant\Contracts\RestaurantRepoInterface;
use App\Modules\RestaurantPanel\Restaurant\Repositories\RestaurantRepo;
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
        Gate::policy(Restaurant::class, RestaurantPolicy::class);
        Gate::policy(RestaurantApplication::class, ApplicationPolicy::class);
    }
}
