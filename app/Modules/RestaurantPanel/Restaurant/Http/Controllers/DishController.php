<?php

namespace App\Modules\RestaurantPanel\Restaurant\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\RestaurantPanel\Restaurant\DTOs\DishData;
use App\Modules\RestaurantPanel\Restaurant\Http\Requests\DishRequest;
use App\Modules\RestaurantPanel\Restaurant\Models\Dish;
use App\Modules\RestaurantPanel\Restaurant\Services\DishService;
use App\Modules\RestaurantPanel\Restaurant\Services\MenuCategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DishController extends Controller
{
    public function __construct(
        private readonly DishService $service,
        private readonly MenuCategoryService $categoryService,
    ) {}

    public function index(): View
    {
        $this->authorize('viewAny', Dish::class);
        $dishes = $this->service->getDishes();
        return view('panel.restaurant.dishes.index', compact('dishes'));
    }

    public function show(Dish $dish): View
    {
        $this->authorize('view', $dish);
        return view('panel.restaurant.dishes.show', compact('dish'));
    }

    public function create(): View
    {
        $this->authorize('create', Dish::class);
        $categories = $this->categoryService->getMenuCategories();
        return view('panel.restaurant.dishes.create', compact('categories'));
    }

    public function store(DishRequest $request): RedirectResponse
    {
        $this->authorize('create', Dish::class);
        $this->service->store(DishData::from($request->validated()));
        return redirect()->route('admin.dishes.index');
    }

    public function edit(Dish $dish): View
    {
        $this->authorize('update', $dish);
        $categories = $this->categoryService->getMenuCategories();
        return view('panel.restaurant.dishes.edit', compact('dish', 'categories'));
    }

    public function update(Dish $dish, DishRequest $request): RedirectResponse
    {
        $this->authorize('update', $dish);
        $this->service->update($dish, DishData::from($request->validated()));
        return redirect()->route('admin.dishes.index');
    }

    public function destroy(Dish $dish): RedirectResponse
    {
        $this->authorize('delete', $dish);
        $this->service->delete($dish);
        return redirect()->route('admin.dishes.index');
    }
}
