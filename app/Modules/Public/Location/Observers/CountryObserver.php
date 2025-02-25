<?php

namespace App\Modules\Public\Location\Observers;

use App\Modules\Admin\Location\Models\Country;
use Illuminate\Support\Facades\Cache;

class CountryObserver
{
    public function created(Country $country): void
    {
        $this->clearCountriesCache();
    }

    public function updated(Country $country): void
    {
        $this->clearCountriesCache();
    }

    public function deleted(Country $country): void
    {
        $this->clearCountriesCache();
    }

    protected function clearCountriesCache(): void
    {
        Cache::forget('public_countries');
    }
}
