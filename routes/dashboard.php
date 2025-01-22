<?php

use App\Http\Controllers\Dashboard\LanguageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\ClassificationController;
Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::resource('languages', LanguageController::class);
});

Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::resource('classifications', ClassificationController::class);
});
