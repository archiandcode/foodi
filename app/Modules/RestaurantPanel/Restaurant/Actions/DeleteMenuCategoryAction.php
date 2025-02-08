<?php

namespace App\Modules\RestaurantPanel\Restaurant\Actions;

use App\Modules\RestaurantPanel\Restaurant\Models\MenuCategory;

class DeleteMenuCategoryAction
{
    public function execute(MenuCategory $category): bool
    {
        return !$category->dishes()->exists() && $category->delete();
    }
}
