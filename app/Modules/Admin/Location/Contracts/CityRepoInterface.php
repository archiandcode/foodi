<?php

namespace App\Modules\Admin\Location\Contracts;

use App\Modules\Admin\Location\Models\Country;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface CityRepoInterface
{
    public function getByCountryId(int $countryId): Collection;
    public function paginateByCountryId(int $countryId): LengthAwarePaginator;
    public function getDefaultCity(Country $country);
}
