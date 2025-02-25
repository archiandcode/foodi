<?php

use App\Modules\Auth\Http\Controllers\UserAuthController;
use App\Modules\Public\Carts\Http\Controllers\AddToCartController;
use App\Modules\Public\Carts\Http\Controllers\CartController;
use App\Modules\Public\Carts\Http\Controllers\GetCartItemsController;
use App\Modules\Public\Location\Http\Controllers\LocationController;
use App\Modules\Public\Orders\Http\Controllers\CreateOrderController;
use App\Modules\Public\Restaurant\Http\Controllers\HomeController;
use App\Modules\Public\Restaurant\Http\Controllers\RestaurantApplicationController;
use App\Modules\Public\Restaurant\Http\Controllers\RestaurantController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {
    Route::get('/login', [UserAuthController::class, 'loginForm'])->name('login.form');
    Route::get('/register', [UserAuthController::class, 'registerForm'])->name('register.form');
    Route::post('/login', [UserAuthController::class, 'login'])->name('login');
    Route::post('/register', [UserAuthController::class, 'register'])->name('register');
    Route::post('/logout', [UserAuthController::class, 'logout'])->name('logout')
        ->middleware('auth')
        ->withoutMiddleware('guest');
});

Route::get('/send-application', [RestaurantApplicationController::class, 'create'])->name('restaurant_application.create');
Route::post('/send-application', [RestaurantApplicationController::class, 'store'])->name('restaurant_application.store');


Route::middleware('auth')->group(function () {
    Route::post('/cart/add', [AddToCartController::class, 'add'])->name('cart.add');
    Route::post('/cart/increment', [AddToCartController::class, 'increment'])->name('cart.increment');
    Route::post('/cart/decrement', [AddToCartController::class, 'decrement'])->name('cart.decrement');
    Route::get('/cart/items', GetCartItemsController::class)->name('cart.get.items');
    Route::get('cart', [CartController::class, 'index'])->name('cart.index');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('restaurant/{restaurant}', [HomeController::class, 'dishes'])->name('restaurant.dishes');

Route::post('/order', CreateOrderController::class)->name('order.store');

Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurants.index');

Route::prefix('location')->name('location.')->group(function () {
    Route::get('/countries', [LocationController::class, 'getCountries'])->name('countries');
    Route::get('/cities', [LocationController::class, 'getCities'])->name('cities');
});

