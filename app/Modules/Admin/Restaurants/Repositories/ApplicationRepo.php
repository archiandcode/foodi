<?php

namespace App\Modules\Admin\Restaurants\Repositories;

use App\Modules\Admin\Restaurants\Contracts\ApplicationRepoInterface;
use App\Modules\Public\RestaurantApplication\Models\RestaurantApplication;
use Illuminate\Pagination\LengthAwarePaginator;

class ApplicationRepo implements ApplicationRepoInterface
{
    function getAllWithFilters(array $filters): LengthAwarePaginator
    {
        $query = RestaurantApplication::query();

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        $sort = $filters['sort'] ?? 'desc';
        $query->orderBy('id', $sort);

        return $query->paginate(20)->appends($filters);
    }

}
