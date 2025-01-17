<?php

use App\Modules\RestaurantPanel\Dishes\Http\Controllers\DishController;
use App\Modules\RestaurantPanel\Dishes\Http\Controllers\MenuCategoryController;
use Illuminate\Support\Facades\Route;

Route::resource('menu_categories', MenuCategoryController::class);
Route::resource('dishes', DishController::class);
