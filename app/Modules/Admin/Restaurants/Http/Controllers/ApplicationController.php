<?php

namespace App\Modules\Admin\Restaurants\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Restaurants\Services\ApplicationService;
use App\Modules\Public\RestaurantApplication\Models\RestaurantApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ApplicationController extends Controller
{
    public function __construct(
        private readonly ApplicationService $service
    ) {}
    public function index(): View
    {
        return view('panel.restaurants.applications.index', $this->service->get());
    }

    public function show(RestaurantApplication $application): View
    {
        return view('panel.restaurants.applications.show', compact('application'));
    }

    public function approve(RestaurantApplication $application): RedirectResponse
    {
        $this->service->approve($application);
        return redirect()->back();
    }

    public function reject(RestaurantApplication $application): RedirectResponse
    {
        $this->service->reject($application);
        return redirect()->back();
    }
}
