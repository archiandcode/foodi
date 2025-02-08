<?php

use App\Modules\Auth\Http\Controllers\UserAuthController;
use App\Modules\Public\RestaurantApplication\Http\Controllers\RestaurantApplicationController;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

Route::middleware('guest')->group(function () {
    Route::get('/login', [UserAuthController::class, 'loginForm'])->name('login.form');
    Route::get('/register', [UserAuthController::class, 'registerForm'])->name('register.form');
    Route::post('/login', [UserAuthController::class, 'login'])->name('login');
    Route::post('/register', [UserAuthController::class, 'register'])->name('register');
    Route::post('/logout', [UserAuthController::class, 'logout'])->name('logout');
});

Route::get('/', function (): View {
    return view('public.home.index');
})->name('home');

Route::get('/send-application', [RestaurantApplicationController::class, 'create'])->name('restaurant_application.create');
Route::post('/send-application', [RestaurantApplicationController::class, 'store'])->name('restaurant_application.store');

Route::view('/map', 'map');
