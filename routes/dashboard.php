<?php

use App\Http\Controllers\Dashboard\LanguageController;
use App\Http\Controllers\Dashboard\CountryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\ClassificationController;
use App\Http\Controllers\Dashboard\GenreController;
use App\Http\Controllers\Dashboard\HallTypeController;
use App\Http\Controllers\Dashboard\ScreenTypeController;

Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('classifications/import', [ClassificationController::class, 'showImport'])->name('classifications.import.show');
    Route::post('classifications/import', [ClassificationController::class, 'import'])->name('classifications.import');
    Route::get('classifications/export', [ClassificationController::class, 'export'])->name('classifications.export')->withoutMiddleware(['web']);

    Route::get('languages/{language}/delete', [LanguageController::class, 'delete'])->name('languages.delete');
    Route::get('countries/{country}/delete', [CountryController::class, 'delete'])->name('countries.delete');
    Route::get('hall_types/{hall_type}/delete', [HallTypeController::class, 'delete'])->name('hall_types.delete');
    Route::get('genres/{genre}/delete', [GenreController::class, 'delete'])->name('genres.delete');
    Route::get('screen_types/{screen_type}/delete', [ScreenTypeController::class, 'delete'])->name('screen_types.delete');
    Route::get('classifications/{classification}/delete', [ClassificationController::class, 'delete'])->name('classifications.delete');

    Route::resource('languages', LanguageController::class);
    Route::resource('countries', CountryController::class);
    Route::resource('classifications', ClassificationController::class);
    Route::resource('genres', GenreController::class);
    Route::resource('halltypes', HallTypeController::class);
    Route::resource('screen_types', ScreenTypeController::class);
});



