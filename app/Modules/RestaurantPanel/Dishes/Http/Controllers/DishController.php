<?php

namespace App\Modules\RestaurantPanel\Dishes\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Restaurants\Models\Restaurant;
use App\Modules\RestaurantPanel\Dishes\Http\Requests\DishRequest;
use App\Modules\RestaurantPanel\Dishes\Models\Dish;
use App\Modules\RestaurantPanel\Dishes\Models\MenuCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DishController extends Controller
{
    public function index(): View
    {
        $dishes = Dish::all();
        return view('restaurant-panel.dishes.index', compact('dishes'));
    }

    public function show(Dish $dish): View
    {
        return view('restaurant-panel.dishes.show', compact('dish'));
    }

    public function create(): View
    {
        $categories = MenuCategory::all();
        return view('restaurant-panel.dishes.create', compact('categories'));
    }

    public function store(DishRequest $request): RedirectResponse
    {
         Restaurant::query()->first()->dishes()->create($request->validated());
        return redirect()->route('restaurant-panel.dishes.index');
    }

    public function edit(Dish $dish): View
    {
        $categories = MenuCategory::all();
        return view('restaurant-panel.dishes.edit', compact('dish', 'categories'));
    }

    public function update(Dish $dish, DishRequest $request): RedirectResponse
    {
        $dish->update($request->validated());
        return redirect()->route('restaurant-panel.dishes.index');
    }

    public function destroy(Dish $dish): RedirectResponse
    {
        $dish->delete();
        return redirect()->route('restaurant-panel.dishes.index');
    }
}
