<?php

namespace App\Modules\RestaurantPanel\Dishes\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Restaurants\Models\Restaurant;
use App\Modules\RestaurantPanel\Dishes\Http\Requests\MenuCategoryRequest;
use App\Modules\RestaurantPanel\Dishes\Models\MenuCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MenuCategoryController extends Controller
{
    public function index(): View
    {
        $categories = MenuCategory::all();
        $restaurant = Restaurant::query()->first();
        return view('restaurant-panel.menu_categories.index', compact('categories', 'restaurant'));
    }

    public function show(MenuCategory $menuCategory): View
    {
        return view('restaurant-panel.menu_categories.show', compact('menuCategory'));
    }

    public function create(): View
    {
        $restaurant = Restaurant::query()->first();
        return view('restaurant-panel.menu_categories.create', compact('restaurant'));
    }

    public function store(MenuCategoryRequest $request): RedirectResponse
    {
        $restaurant = Restaurant::query()->first();
        $restaurant->categories()->create($request->validated());
        return redirect()->route('restaurant-panel.menu_categories.index');
    }

    public function edit(MenuCategory $menuCategory): View
    {
        return view('restaurant-panel.menu_categories.edit', compact('menuCategory'));
    }

    public function update(MenuCategory $menuCategory, MenuCategoryRequest $request): RedirectResponse
    {
        $menuCategory->update($request->validated());
        return redirect()->route('restaurant-panel.menu_categories.index');
    }

    public function destroy(MenuCategory $menuCategory): RedirectResponse
    {
        $menuCategory->delete();
        return redirect()->route('restaurant-panel.menu_categories.index');
    }
}
