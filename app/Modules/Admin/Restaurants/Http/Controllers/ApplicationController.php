<?php

namespace App\Modules\Admin\Restaurants\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Restaurants\Services\ApplicationService;
use App\Modules\Public\Restaurant\Models\RestaurantApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ApplicationController extends Controller
{
    public function __construct(
        private readonly ApplicationService $service
    ) {}

    public function index(): View
    {
        $this->authorize('viewAny', RestaurantApplication::class);

        return view('panel.admin.restaurants.applications.index', $this->service->get());
    }

    public function show(RestaurantApplication $application): View
    {
        $this->authorize('view', $application);

        return view('panel.admin.restaurants.applications.show', compact('application'));
    }

    public function approve(RestaurantApplication $application): RedirectResponse
    {
        $this->authorize('approve', $application);

        $this->service->approve($application);
        return redirect()->back();
    }

    public function reject(RestaurantApplication $application): RedirectResponse
    {
        $this->authorize('reject', $application);

        $this->service->reject($application);
        return redirect()->back();
    }
}
