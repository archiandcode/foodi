<?php

use App\Modules\Admin\Location\Http\Controllers\CityController;
use App\Modules\Admin\Location\Http\Controllers\CountryController;
use App\Modules\Admin\Restaurants\Http\Controllers\ApplicationController;
use App\Modules\Admin\Restaurants\Http\Controllers\RestaurantController;
use App\Modules\Auth\Http\Controllers\StaffAuthController;
use App\Modules\RestaurantPanel\Orders\Http\Controllers\OrderController;
use App\Modules\RestaurantPanel\Restaurant\Http\Controllers\AddressController;
use App\Modules\RestaurantPanel\Restaurant\Http\Controllers\DishController;
use App\Modules\RestaurantPanel\Restaurant\Http\Controllers\MenuCategoryController;
use App\Modules\RestaurantPanel\Restaurant\Http\Controllers\RestaurantController as MyRestaurantController;
use App\Modules\StaffUser\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Авторизация (гость)
|--------------------------------------------------------------------------
*/
Route::middleware('guest:staff')->group(function () {
    Route::get('/login', [StaffAuthController::class, 'loginForm'])->name('login.form');
    Route::post('/login', [StaffAuthController::class, 'login'])->name('login');
});

/*
|--------------------------------------------------------------------------
| Админка и панель ресторана (только для staff)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:staff')->group(function () {

    // Выход
    Route::post('/logout', [StaffAuthController::class, 'logout'])->name('logout');

    /*
    |--------------------------------------------------------------------------
    | Управление странами и городами
    |--------------------------------------------------------------------------
    */
    Route::resource('countries', CountryController::class);
    Route::prefix('countries/{country}')->group(function () {
        Route::resource('cities', CityController::class);
    });

    /*
    |--------------------------------------------------------------------------
    | Управление ресторанами (админ)
    |--------------------------------------------------------------------------
    */
    Route::resource('restaurants', RestaurantController::class)->except(['destroy', 'create', 'store']);
    Route::prefix('restaurants/{restaurant}')->group(function () {
        Route::post('ban', [RestaurantController::class, 'ban'])->name('restaurants.ban');
//        Route::post('unban', [RestaurantController::class, 'unban'])->name('restaurants.unban');
        // Можно раскомментировать, если понадобится:
        // Route::post('accept', [RestaurantController::class, 'accept'])->name('restaurants.accept');
        // Route::post('reject', [RestaurantController::class, 'reject'])->name('restaurants.reject');
    });

    /*
    |--------------------------------------------------------------------------
    | Заявки на подключение ресторанов
    |--------------------------------------------------------------------------
    */
    Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications/{application}', [ApplicationController::class, 'show'])->name('applications.show');
    Route::post('/applications/{application}/approve', [ApplicationController::class, 'approve'])->name('applications.approve');
    Route::post('/applications/{application}/reject', [ApplicationController::class, 'reject'])->name('applications.reject');

    /*
    |--------------------------------------------------------------------------
    | Профиль пользователя (staff)
    |--------------------------------------------------------------------------
    */
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('profile');
        Route::put('/', [ProfileController::class, 'update'])->name('profile.update');
    });

    /*
    |--------------------------------------------------------------------------
    | Панель ресторана — управление данными
    |--------------------------------------------------------------------------
    */
    Route::prefix('restaurant')->group(function () {
        Route::get('/', [MyRestaurantController::class, 'index'])->name('restaurant.index');
        Route::get('/edit', [MyRestaurantController::class, 'edit'])->name('restaurant.edit');
        Route::put('/', [MyRestaurantController::class, 'update'])->name('restaurant.update');

        Route::resource('addresses', AddressController::class);
    });

    /*
    |--------------------------------------------------------------------------
    | Меню и блюда
    |--------------------------------------------------------------------------
    */
    Route::resource('menu_categories', MenuCategoryController::class);
    Route::resource('dishes', DishController::class);

    /*
    |--------------------------------------------------------------------------
    | Заказы
    |--------------------------------------------------------------------------
    */
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('orders.index');
    });
});
