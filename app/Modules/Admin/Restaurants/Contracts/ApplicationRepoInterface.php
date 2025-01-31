<?php

namespace App\Modules\Admin\Restaurants\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;

interface ApplicationRepoInterface
{
    function getAllWithFilters(array $filters): LengthAwarePaginator;
}
