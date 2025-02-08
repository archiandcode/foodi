<?php

namespace App\Modules\Admin\Restaurants\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Restaurants\Http\Requests\RestaurantRequest;
use App\Modules\Admin\Restaurants\Models\Restaurant;
use App\Modules\Admin\Restaurants\Services\RestaurantService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RestaurantController extends Controller
{
    public function __construct(
        protected RestaurantService $service
    ) {}

    public function index(): View
    {
        $this->authorize('viewAny', Restaurant::class);

        $restaurants = Restaurant::query()->where('is_banned', false)->get();
        return view('panel.restaurants.index', compact('restaurants'));
    }

    public function show(Restaurant $restaurant): View
    {
        $this->authorize('view', $restaurant);

        return view('panel.restaurants.show', compact('restaurant'));
    }

    public function create(): View
    {
        $this->authorize('create', Restaurant::class);

        return view('panel.restaurants.create');
    }

    public function edit(Restaurant $restaurant): View
    {
        $this->authorize('update', $restaurant);

        return view('panel.restaurants.edit', compact('restaurant'));
    }

    public function update(Restaurant $restaurant, RestaurantRequest $request): RedirectResponse
    {
        $this->authorize('update', $restaurant);

        $restaurant->update($request->validated());
        return redirect()->route('admin.restaurants.index');
    }

    public function ban(Restaurant $restaurant): RedirectResponse
    {
        $this->authorize('ban', $restaurant);

        $restaurant->is_banned = true;
        $restaurant->save();
        return redirect()->route('admin.restaurants.index');
    }

    public function unban(Restaurant $restaurant): RedirectResponse
    {
        $this->authorize('unban', $restaurant);

        $restaurant->is_banned = false;
        $restaurant->save();
        return redirect()->route('admin.restaurants.index');
    }
}
