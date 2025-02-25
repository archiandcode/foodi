<?php

namespace App\Modules\Public\Providers;

use App\Modules\Admin\Location\Models\City;
use App\Modules\Admin\Location\Models\Country;
use App\Modules\Public\Carts\Contracts\CartItemRepoInterface;
use App\Modules\Public\Carts\Contracts\CartRepoInterface;
use App\Modules\Public\Carts\Repositories\CartItemRepo;
use App\Modules\Public\Carts\Repositories\CartRepo;
use App\Modules\Public\Location\Observers\CityObserver;
use App\Modules\Public\Location\Observers\CountryObserver;
use Carbon\Laravel\ServiceProvider;

class PublicServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CartItemRepoInterface::class, CartItemRepo::class);
        $this->app->bind(CartRepoInterface::class, CartRepo::class);
    }

    public function boot(): void
    {
        City::observe(CityObserver::class);
        Country::observe(CountryObserver::class);
    }
}
