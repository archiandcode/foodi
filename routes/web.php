<?php

use App\Modules\Auth\Http\Controllers\UserAuthController;
use App\Modules\Public\Carts\Http\Controllers\AddToCartController;
use App\Modules\Public\Carts\Http\Controllers\CartController;
use App\Modules\Public\Carts\Http\Controllers\GetCartItemsController;
use App\Modules\Public\Location\Http\Controllers\LocationController;
use App\Modules\Public\Orders\Http\Controllers\OrderController;
use App\Modules\Public\Profile\Http\Controllers\ProfileController;
use App\Modules\Public\Restaurant\Http\Controllers\RestaurantApplicationController;
use App\Modules\Public\Restaurant\Http\Controllers\RestaurantController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Гостевые маршруты
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [UserAuthController::class, 'loginForm'])->name('login.form');
    Route::get('/register', [UserAuthController::class, 'registerForm'])->name('register.form');
    Route::post('/login', [UserAuthController::class, 'login'])->name('login');
    Route::post('/register', [UserAuthController::class, 'register'])->name('register');
});

// Выход доступен только авторизованным
Route::post('/logout', [UserAuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

/*
|--------------------------------------------------------------------------
| Главная и рестораны
|--------------------------------------------------------------------------
*/
Route::get('/', [RestaurantController::class, 'index'])->name('home');
Route::get('/restaurants', [RestaurantController::class, 'json'])->name('restaurants.index');
Route::get('/restaurant/{restaurant}', [RestaurantController::class, 'show'])->name('restaurant.dishes');

/*
|--------------------------------------------------------------------------
| Заявка на подключение ресторана
|--------------------------------------------------------------------------
*/
Route::get('/send-application', [RestaurantApplicationController::class, 'create'])->name('restaurant_application.create');
Route::post('/send-application', [RestaurantApplicationController::class, 'store'])->name('restaurant_application.store');

/*
|--------------------------------------------------------------------------
| Корзина, заказы и профиль (только для авторизованных)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::post('/cart/add', [AddToCartController::class, 'add'])->name('cart.add');
    Route::post('/cart/increment', [AddToCartController::class, 'increment'])->name('cart.increment');
    Route::post('/cart/decrement', [AddToCartController::class, 'decrement'])->name('cart.decrement');
    Route::get('/cart/items', GetCartItemsController::class)->name('cart.get.items');
    Route::delete('/cart/clear', [AddToCartController::class, 'clear'])->name('cart.clear');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
    Route::get('/orders', [OrderController::class, 'json'])->name('orders.index');

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/', [ProfileController::class, 'update'])->name('update');
    });
});


/*
|--------------------------------------------------------------------------
| Страны и города
|--------------------------------------------------------------------------
*/
Route::prefix('location')->name('location.')->group(function () {
    Route::get('/countries', [LocationController::class, 'getCountries'])->name('countries');
    Route::get('/cities', [LocationController::class, 'getCities'])->name('cities');
});
