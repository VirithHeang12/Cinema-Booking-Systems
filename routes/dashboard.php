<?php

use App\Http\Controllers\Dashboard\LanguageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\ClassificationController;
use App\Http\Controllers\Dashboard\GenreController;
Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('languages/{language}/delete', [LanguageController::class, 'delete'])->name('languages.delete');
    Route::get('genres/{genre}/delete', [GenreController::class, 'delete'])->name('genres.delete');

    Route::resource('languages', LanguageController::class);
    Route::resource('classifications', ClassificationController::class);
    Route::resource('genres', GenreController::class);
});

