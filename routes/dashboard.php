<?php

use App\Http\Controllers\Dashboard\LanguageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\ClassificationController;
Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('languages/{language}/delete', [LanguageController::class, 'delete'])->name('languages.delete');

    Route::resource('languages', LanguageController::class);
    Route::resource('classifications', ClassificationController::class);
});

