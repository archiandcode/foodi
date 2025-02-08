<?php

namespace App\Modules\RestaurantPanel\Restaurant\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Restaurants\Models\Restaurant;
use App\Modules\RestaurantPanel\Restaurant\DTOs\MenuCategoryData;
use App\Modules\RestaurantPanel\Restaurant\Http\Requests\MenuCategoryRequest;
use App\Modules\RestaurantPanel\Restaurant\Models\MenuCategory;
use App\Modules\RestaurantPanel\Restaurant\Services\MenuCategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MenuCategoryController extends Controller
{
    public function __construct(
        private readonly MenuCategoryService $service
    ){}
    public function index(): View
    {
        $categories = $this->service->getMenuCategories();
        return view('panel.restaurant.menu_categories.index', compact('categories'));
    }

    public function show(MenuCategory $menuCategory): View
    {
        return view('panel.restaurant.menu_categories.show', compact('menuCategory'));
    }

    public function create(): View
    {
        $restaurant = Restaurant::query()->first();
        return view('panel.restaurant.menu_categories.create', compact('restaurant'));
    }

    public function store(MenuCategoryRequest $request): RedirectResponse
    {
        $this->service->store(MenuCategoryData::from($request->validated()));
        return redirect()->route('admin.menu_categories.index');
    }

    public function edit(MenuCategory $menuCategory): View
    {
        return view('panel.restaurant.menu_categories.edit', compact('menuCategory'));
    }

    public function update(MenuCategory $menuCategory, MenuCategoryRequest $request): RedirectResponse
    {
        $menuCategory->update($request->validated());
        return redirect()->route('admin.menu_categories.index');
    }

    public function destroy(MenuCategory $menuCategory): RedirectResponse
    {
        $deleted = $this->service->delete($menuCategory);

        if (! $deleted) {
            return redirect()
                ->route('admin.menu_categories.index')
                ->with('error', __('Нельзя удалить категорию, так как в ней есть блюда.'));
        }

        return redirect()
            ->route('admin.menu_categories.index')
            ->with('success', __('Категория успешно удалена.'));
    }
}
