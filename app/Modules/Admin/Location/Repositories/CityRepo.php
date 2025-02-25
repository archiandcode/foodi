<?php

namespace App\Modules\Admin\Location\Repositories;

use App\Modules\Admin\Location\Contracts\CityRepoInterface;
use App\Modules\Admin\Location\Models\City;
use App\Modules\Admin\Location\Models\Country;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CityRepo implements CityRepoInterface
{
    public function getByCountryId(int $countryId): Collection
    {
        return City::query()->where('country_id', $countryId)->get();
    }

    public function paginateByCountryId(int $countryId, int $perPage = 15): LengthAwarePaginator
    {
        return City::query()->where('country_id', $countryId)->paginate($perPage);
    }

    public function getDefaultCity(Country $country)
    {
        return $country->cities()->where('is_default', true)->first();
    }
}
