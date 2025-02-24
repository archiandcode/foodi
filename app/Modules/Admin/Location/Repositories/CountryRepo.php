<?php

namespace App\Modules\Admin\Location\Repositories;

use App\Modules\Admin\Location\Contracts\CountryRepoInterface;
use App\Modules\Admin\Location\Models\Country;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CountryRepo implements CountryRepoInterface
{
    public function getAll(): Collection
    {
        return Country::query()->get();
    }
    public function getAllWithPaginate(): LengthAwarePaginator
    {
        return Country::query()->paginate(20);
    }


}
