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
    ){}

    public function index(): View
    {
        $restaurants = Restaurant::query()->where('is_banned', false)->get();
        return view('panel.restaurants.index', compact('restaurants'));
    }

    public function show(Restaurant $restaurant): View
    {
        return view('panel.restaurants.show', compact('restaurant'));
    }

    public function create(): View
    {
        return view('panel.restaurants.create');
    }

    public function edit(Restaurant $restaurant): View
    {
        return view('panel.restaurants.edit', compact('restaurant'));
    }

    public function update(Restaurant $restaurant, RestaurantRequest $request): RedirectResponse
    {
        $restaurant->update($request->validated());
        return redirect()->route('admin.restaurants.index');
    }

    public function ban(Restaurant $restaurant): RedirectResponse
    {
        $restaurant->is_banned = true;
        $restaurant->save();
        return redirect()->route('admin.restaurants.index');
    }

    public function unban(Restaurant $restaurant): RedirectResponse
    {
        $restaurant->is_banned = false;
        $restaurant->save();
        return redirect()->route('admin.restaurants.index');
    }
}
