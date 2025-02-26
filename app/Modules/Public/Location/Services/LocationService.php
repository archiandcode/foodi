<?php

namespace App\Modules\Public\Location\Services;

use App\Modules\Admin\Location\Contracts\CityRepoInterface;
use App\Modules\Admin\Location\Contracts\CountryRepoInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class LocationService
{
    public function __construct(
        protected CountryRepoInterface $countryRepo,
        protected CityRepoInterface $cityRepo,
    ) {}

    public function getCountries(): Collection
    {
        return Cache::remember('public_countries', now()->addHours(24), function () {
            return $this->countryRepo->getAll();
        });
    }

    public function getCities(int $countryId): Collection
    {
        $cacheKey = "public_cities_for_country_{$countryId}";

        return Cache::remember($cacheKey, now()->addHours(24), function () use ($countryId) {
            return $this->cityRepo->getByCountryId($countryId);
        });
    }
}
