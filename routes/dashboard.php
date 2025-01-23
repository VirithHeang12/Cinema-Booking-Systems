<?php

use App\Http\Controllers\Dashboard\LanguageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\ClassificationController;
use App\Http\Controllers\Dashboard\ScreenTypeController;

Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::resource('languages', LanguageController::class);
    Route::resource('classifications', ClassificationController::class);
    Route::resource('screen-types', ScreenTypeController::class);
});

