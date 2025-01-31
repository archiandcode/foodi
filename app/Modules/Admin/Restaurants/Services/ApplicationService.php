<?php

namespace App\Modules\Admin\Restaurants\Services;

use App\Modules\Admin\Restaurants\Actions\ApproveApplicationAction;
use App\Modules\Admin\Restaurants\Actions\CreateOwnerAction;
use App\Modules\Admin\Restaurants\Actions\CreateRestaurantAction;
use App\Modules\Admin\Restaurants\Actions\RejectApplicationAction;
use App\Modules\Admin\Restaurants\Contracts\ApplicationRepoInterface;
use App\Modules\Admin\Restaurants\DTOs\OwnerData;
use App\Modules\Admin\Restaurants\DTOs\RestaurantData;
use App\Modules\Public\RestaurantApplication\Enums\RestaurantApplicationEnum;
use App\Modules\Public\RestaurantApplication\Models\RestaurantApplication;
use Illuminate\Support\Facades\DB;

class ApplicationService
{

    public function __construct(
        public ApproveApplicationAction $approveApplicationAction,
        public RejectApplicationAction $rejectApplicationAction,
        public CreateOwnerAction $createOwnerAction,
        public CreateRestaurantAction $createRestaurantAction,
        public ApplicationRepoInterface $applicationRepo,
    ){}

    public function get(): array
    {
        $filters = request()->only(['status', 'sort']);
        $applications  = $this->applicationRepo->getAllWithFilters($filters);
        $statuses = RestaurantApplicationEnum::cases();

        return compact('applications', 'filters', 'statuses');
    }

    public function approve(RestaurantApplication $application): void
    {
        DB::transaction(function () use ($application) {
            $this->approveApplicationAction->execute($application);
            $restaurant = $this->createRestaurantAction->execute(RestaurantData::fromApplication($application));
            $this->createOwnerAction->execute(OwnerData::fromApplication($application, $restaurant->id));
        });
    }

    public function reject(RestaurantApplication $application): void
    {
        DB::transaction(function () use ($application) {
            $this->rejectApplicationAction->execute($application);
        });
    }
}
