<?php

namespace App\Modules\Admin\Location\Services;

use App\Modules\Admin\Location\Actions\CreateCityAction;
use App\Modules\Admin\Location\Actions\UnsetDefaultCityAction;
use App\Modules\Admin\Location\Actions\UpdateCityAction;
use App\Modules\Admin\Location\Contracts\CityRepoInterface;
use App\Modules\Admin\Location\DTOs\CityData;
use App\Modules\Admin\Location\Models\City;
use App\Modules\Admin\Location\Models\Country;
use Illuminate\Support\Facades\DB;

class CityService
{
    public function __construct(
        protected CityRepoInterface $cityRepo,
        protected UnsetDefaultCityAction $unsetDefaultCityAction,
        protected CreateCityAction $createCityAction,
        protected UpdateCityAction $updateCityAction,
    ) {}

    public function store(Country $country, CityData $data): void
    {
        DB::transaction(function () use ($country, $data) {
            if ($data->is_default)
            {
                $city = $this->cityRepo->getDefaultCity($country);
                $this->unsetDefaultCityAction->execute($city);
            }

            $this->createCityAction->execute($country, $data);
        });
    }

    public function update(Country $country, City $city, CityData $data): void
    {
        DB::transaction(function () use ($country, $city, $data) {
            if ($data->is_default)
            {
                $city = $this->cityRepo->getDefaultCity($country);
                $this->unsetDefaultCityAction->execute($city);
            }
            $this->updateCityAction->execute($city, $data);
        });
    }
}
