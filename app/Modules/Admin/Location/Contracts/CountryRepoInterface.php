<?php

namespace App\Modules\Admin\Location\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface CountryRepoInterface
{
    public function getAll(): Collection;

    public function getAllWithPaginate(): LengthAwarePaginator;
}
