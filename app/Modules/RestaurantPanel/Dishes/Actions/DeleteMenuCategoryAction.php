<?php

namespace App\Modules\RestaurantPanel\Dishes\Actions;

use App\Modules\RestaurantPanel\Dishes\Models\MenuCategory;

class DeleteMenuCategoryAction
{
    public function execute(MenuCategory $category): bool
    {
        return !$category->dishes()->exists() && $category->delete();
    }
}
