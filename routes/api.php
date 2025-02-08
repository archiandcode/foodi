<?php

use App\Modules\Api\Location\Controllers\CityController;
use App\Modules\Api\Location\Controllers\CountryController;
use Illuminate\Support\Facades\Route;

Route::name('api.')->group(function () {
    Route::get('/countries', [CountryController::class, 'index'])->name('countries.index');
    Route::get('/cities', [CityController::class, 'index'])->name('cities.index');
});
