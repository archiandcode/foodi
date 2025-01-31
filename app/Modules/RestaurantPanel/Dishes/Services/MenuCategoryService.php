<?php

namespace App\Modules\RestaurantPanel\Dishes\Services;

use App\Modules\Admin\Restaurants\Contracts\RestaurantRepoInterface;
use App\Modules\RestaurantPanel\Dishes\Actions\CreateMenuCategoryAction;
use App\Modules\RestaurantPanel\Dishes\Actions\DeleteMenuCategoryAction;
use App\Modules\RestaurantPanel\Dishes\Contracts\MenuCategoryRepoInterface;
use App\Modules\RestaurantPanel\Dishes\DTOs\MenuCategoryData;
use App\Modules\RestaurantPanel\Dishes\Models\MenuCategory;
use App\Modules\RestaurantPanel\Dishes\Traits\HasCurrentRestaurant;
use Illuminate\Pagination\LengthAwarePaginator;

class MenuCategoryService
{
    use HasCurrentRestaurant;

    public function __construct(
        RestaurantRepoInterface $restaurantRepo,
        protected MenuCategoryRepoInterface $menuCategoryRepo,
        protected CreateMenuCategoryAction $createMenuCategoryAction,
        protected DeleteMenuCategoryAction $deleteMenuCategoryAction,
    ){
        $this->setRestaurantRepo($restaurantRepo);
    }

    public function getMenuCategories(): LengthAwarePaginator
    {
        $restaurant = $this->getRestaurant();
        return $this->menuCategoryRepo->getMenuCategoriesByRestaurant($restaurant);
    }

    public function store(array $data): void
    {
        $restaurant = $this->getRestaurant();
        $this->createMenuCategoryAction->execute($restaurant, MenuCategoryData::from($data));
    }

    public function delete(MenuCategory $category): bool
    {
        return $this->deleteMenuCategoryAction->execute($category);
    }

}
