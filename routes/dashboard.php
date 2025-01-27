<?php

use App\Http\Controllers\Dashboard\LanguageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\ClassificationController;
use App\Http\Controllers\Dashboard\ScreenTypeController;
use App\Models\ScreenType;

Route::prefix('dashboard')->name('dashboard.')->group(function () {

    Route::get('screen-types/{screen_type}/delete', [ScreenTypeController::class, 'delete'])->name('screen-types.delete');

    Route::resource('languages', LanguageController::class);
    Route::resource('classifications', ClassificationController::class);
    Route::resource('screen-types', ScreenTypeController::class);
});

