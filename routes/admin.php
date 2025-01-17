<?php

use App\Modules\Location\Http\Controllers\CityController;
use App\Modules\Location\Http\Controllers\CountryController;
use App\Modules\Restaurant\Http\Controllers\RestaurantController;
use Illuminate\Support\Facades\Route;

Route::resource('countries', CountryController::class);

Route::prefix('countries/{country}')->group(function () {
    Route::resource('cities', CityController::class);
});

Route::resource('restaurants', RestaurantController::class)->except('destroy', 'create', 'store');

Route::prefix('restaurants/{restaurant}')->group(function () {
    Route::post('accept', [RestaurantController::class, 'accept'])->name('restaurants.accept');
    Route::post('reject', [RestaurantController::class, 'reject'])->name('restaurants.reject');
    Route::post('ban', [RestaurantController::class, 'ban'])->name('restaurants.ban');
    Route::post('unban', [RestaurantController::class, 'unban'])->name('restaurants.unban');
});
