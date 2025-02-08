<?php

namespace App\Modules\RestaurantPanel\Restaurant\Services;

use App\Modules\RestaurantPanel\Restaurant\Actions\CreateMenuCategoryAction;
use App\Modules\RestaurantPanel\Restaurant\Actions\DeleteMenuCategoryAction;
use App\Modules\RestaurantPanel\Restaurant\Contracts\MenuCategoryRepoInterface;
use App\Modules\RestaurantPanel\Restaurant\DTOs\MenuCategoryData;
use App\Modules\RestaurantPanel\Restaurant\Models\MenuCategory;
use App\Modules\RestaurantPanel\Restaurant\Traits\HasCurrentRestaurant;
use App\Modules\RestaurantPanel\Restaurant\Contracts\RestaurantRepoInterface;
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

    public function store(MenuCategoryData $data): void
    {
        $restaurant = $this->getRestaurant();
        $this->createMenuCategoryAction->execute($restaurant, $data);
    }

    public function delete(MenuCategory $category): bool
    {
        return $this->deleteMenuCategoryAction->execute($category);
    }

}
