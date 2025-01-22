<?php

use App\Http\Controllers\Dashboard\LanguageController;
use App\Http\Controllers\Dashboard\CountryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\ClassificationController;
Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::resource('languages', LanguageController::class);
    Route::resource('countries', CountryController::class);
    Route::resource('classifications', ClassificationController::class);
});

