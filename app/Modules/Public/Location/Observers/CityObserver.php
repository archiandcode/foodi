<?php

namespace App\Modules\Public\Location\Observers;

use App\Modules\Admin\Location\Models\City;
use Illuminate\Support\Facades\Cache;

class CityObserver
{
    public function created(City $city): void
    {
        $this->clearCityCache($city);
    }

    public function updated(City $city): void
    {
        $this->clearCityCache($city);
    }

    public function deleted(City $city): void
    {
        $this->clearCityCache($city);
    }

    protected function clearCityCache(City $city): void
    {
        Cache::forget("public_cities_for_country_{$city->country_id}");
    }
}
