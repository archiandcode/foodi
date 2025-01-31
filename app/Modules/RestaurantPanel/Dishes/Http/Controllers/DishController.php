<?php

namespace App\Modules\RestaurantPanel\Dishes\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Restaurants\Models\Restaurant;
use App\Modules\RestaurantPanel\Dishes\Http\Requests\DishRequest;
use App\Modules\RestaurantPanel\Dishes\Models\Dish;
use App\Modules\RestaurantPanel\Dishes\Models\MenuCategory;
use App\Modules\RestaurantPanel\Dishes\Services\DishService;
use App\Modules\RestaurantPanel\Dishes\Services\MenuCategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DishController extends Controller
{
    public function __construct(
        private readonly DishService $service,
        private readonly MenuCategoryService $categoryService,
    ){}

    public function index(): View
    {
        $dishes = $this->service->getDishes();
        return view('panel.dishes.index', compact('dishes'));
    }

    public function show(Dish $dish): View
    {
        return view('panel.dishes.show', compact('dish'));
    }

    public function create(): View
    {
        $categories = $this->categoryService->getMenuCategories();
        return view('panel.dishes.create', compact('categories'));
    }

    public function store(DishRequest $request): RedirectResponse
    {
        $this->service->store($request->validated());
        return redirect()->route('admin.dishes.index');
    }

    public function edit(Dish $dish): View
    {
        $categories = $this->categoryService->getMenuCategories();
        return view('panel.dishes.edit', compact('dish', 'categories'));
    }

    public function update(Dish $dish, DishRequest $request): RedirectResponse
    {
        $dish->update($request->validated());
        return redirect()->route('admin.dishes.index');
    }

    public function destroy(Dish $dish): RedirectResponse
    {
        $dish->delete();
        return redirect()->route('admin.dishes.index');
    }
}
