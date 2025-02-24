<?php

namespace App\Modules\Admin\Location\Services;

use App\Modules\Admin\Location\Actions\CreateCountryAction;
use App\Modules\Admin\Location\Actions\UpdateCountryAction;
use App\Modules\Admin\Location\Contracts\CountryRepoInterface;
use App\Modules\Admin\Location\DTOs\CountryData;
use App\Modules\Admin\Location\Models\Country;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CountryService
{
    public function __construct(
        protected CountryRepoInterface $countryRepo,
        protected CreateCountryAction  $createCountryAction,
        protected UpdateCountryAction  $updateCountryAction,
    ){}

    public function getCountries(): Collection
    {
        return $this->countryRepo->getAll();
    }

    public function getCountriesWithPaginate(): LengthAwarePaginator
    {
        return $this->countryRepo->getAllWithPaginate();
    }

    public function store(CountryData $data): void
    {
        $this->createCountryAction->execute($data);
    }

    public function update(Country $country, CountryData $data): void
    {
        $this->updateCountryAction->execute($country, $data);
    }

    public function delete(Country $country): bool
    {
        if ($country->cities()->exists()) {
            return false;
        }

        return $country->delete();
    }
}
