<?php

use App\Http\Controllers\Dashboard\LanguageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\ClassificationController;
use App\Http\Controllers\Dashboard\HallTypeController;

Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('languages/{language}/delete', [LanguageController::class, 'delete'])->name('languages.delete');
    Route::get('halltypes/{halltype}/delete', [HallTypeController::class, 'delete'])->name('halltypes.delete');

    Route::resource('languages', LanguageController::class);
    Route::resource('classifications', ClassificationController::class);
    Route::resource('halltypes', HallTypeController::class);
});

