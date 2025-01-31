<?php

namespace App\Modules\RestaurantPanel\Dishes\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Restaurants\Models\Restaurant;
use App\Modules\Admin\Restaurants\Services\RestaurantService;
use App\Modules\RestaurantPanel\Dishes\Http\Requests\MenuCategoryRequest;
use App\Modules\RestaurantPanel\Dishes\Models\MenuCategory;
use App\Modules\RestaurantPanel\Dishes\Services\MenuCategoryService;
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
        return view('panel.menu_categories.index', compact('categories'));
    }

    public function show(MenuCategory $menuCategory): View
    {
        return view('panel.menu_categories.show', compact('menuCategory'));
    }

    public function create(): View
    {
        $restaurant = Restaurant::query()->first();
        return view('panel.menu_categories.create', compact('restaurant'));
    }

    public function store(MenuCategoryRequest $request): RedirectResponse
    {
        $this->service->store($request->validated());
        return redirect()->route('admin.menu_categories.index');
    }

    public function edit(MenuCategory $menuCategory): View
    {
        return view('panel.menu_categories.edit', compact('menuCategory'));
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
