<?php

namespace App\Modules\Admin\Location\Providers;

use App\Modules\Admin\Location\Contracts\CityRepoInterface;
use App\Modules\Admin\Location\Contracts\CountryRepoInterface;
use App\Modules\Admin\Location\Repositories\CityRepo;
use App\Modules\Admin\Location\Repositories\CountryRepo;
use Illuminate\Support\ServiceProvider;

class LocationServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(CountryRepoInterface::class, CountryRepo::class);
        $this->app->bind(CityRepoInterface::class, CityRepo::class);
    }


    public function boot() {}
}
