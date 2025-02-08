<?php

namespace App\Modules\RestaurantPanel\Restaurant\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\RestaurantPanel\Restaurant\DTOs\RestaurantData;
use App\Modules\RestaurantPanel\Restaurant\Http\Requests\RestaurantRequest;
use App\Modules\RestaurantPanel\Restaurant\Services\RestaurantService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RestaurantController extends Controller
{
    public function __construct(
        private readonly RestaurantService $service,
    ){}

    public function index(): View
    {
        $restaurant = $this->service->getCurrentRestaurant();
        return view('panel.restaurant.index', compact('restaurant'));
    }

    public function edit(): View
    {
        $restaurant = $this->service->getCurrentRestaurant();
        return view('panel.restaurant.edit', compact('restaurant'));
    }

    public function update(RestaurantRequest $request): RedirectResponse
    {
        $this->service->update(RestaurantData::from($request->validated()));
        return redirect()->route('admin.restaurant.index');
    }
}
