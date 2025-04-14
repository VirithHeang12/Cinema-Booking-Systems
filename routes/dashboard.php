<?php

use App\Http\Controllers\Dashboard\LanguageController;
use App\Http\Controllers\Dashboard\CountryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\ClassificationController;
use App\Http\Controllers\Dashboard\GenreController;
use App\Http\Controllers\Dashboard\HallController;
use App\Http\Controllers\Dashboard\HallTypeController;
use App\Http\Controllers\Dashboard\MovieController;
use App\Http\Controllers\Dashboard\ScreenTypeController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\SeatTypeController;
use App\Http\Middleware\RedirectIfUser;

Route::middleware(['auth', RedirectIfUser::class])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::get('classifications/import', [ClassificationController::class, 'showImport'])->name('classifications.import.show');
    Route::post('classifications/import', [ClassificationController::class, 'import'])->name('classifications.import');
    Route::get('classifications/export', [ClassificationController::class, 'export'])->name('classifications.export');

    Route::get('countries/import', [CountryController::class, 'showImport'])->name('countries.import.show');
    Route::post('countries/import', [CountryController::class, 'import'])->name('countries.import');
    Route::get('countries/export', [CountryController::class, 'export'])->name('countries.export');

    Route::get('languages/import', [LanguageController::class, 'showImport'])->name('languages.import.show');
    Route::post('languages/import', [LanguageController::class, 'import'])->name('languages.import');
    Route::get('languages/export', [LanguageController::class, 'export'])->name('languages.export');

    Route::get('genres/import', [GenreController::class, 'showImport'])->name('genres.import.show');
    Route::post('genres/import', [GenreController::class, 'import'])->name('genres.import');
    Route::get('genres/export', [GenreController::class, 'export'])->name('genres.export');

    Route::get('hall_types/import', [HallTypeController::class, 'showImport'])->name('hall_types.import.show');
    Route::post('hall_types/import', [HallTypeController::class, 'import'])->name('hall_types.import');
    Route::get('hall_types/export', [HallTypeController::class, 'export'])->name('hall_types.export');

    Route::get('screen_types/import', [ScreenTypeController::class, 'showImport'])->name('screen_types.import.show');
    Route::post('screen_types/import', [ScreenTypeController::class, 'import'])->name('screen_types.import');
    Route::get('screen_types/export', [ScreenTypeController::class, 'export'])->name('screen_types.export');

    Route::get('seat_types/import', [SeatTypeController::class, 'showImport'])->name('seat_types.import.show');
    Route::post('seat_types/import', [SeatTypeController::class, 'import'])->name('seat_types.import');
    Route::get('seat_types/export', [SeatTypeController::class, 'export'])->name('seat_types.export');

    Route::get('movies/import', [MovieController::class, 'showImport'])->name('movies.import.show');
    Route::post('movies/import', [MovieController::class, 'import'])->name('movies.import');
    Route::get('movies/export', [MovieController::class, 'export'])->name('movies.export');


    Route::get('languages/{language}/delete', [LanguageController::class, 'delete'])->name('languages.delete');
    Route::get('countries/{country}/delete', [CountryController::class, 'delete'])->name('countries.delete');
    Route::get('hall_types/{hall_type}/delete', [HallTypeController::class, 'delete'])->name('hall_types.delete');
    Route::get('genres/{genre}/delete', [GenreController::class, 'delete'])->name('genres.delete');
    Route::get('screen_types/{screen_type}/delete', [ScreenTypeController::class, 'delete'])->name('screen_types.delete');
    Route::get('classifications/{classification}/delete', [ClassificationController::class, 'delete'])->name('classifications.delete');
    Route::get('movies/{movie}/delete', [MovieController::class, 'delete'])->name('movies.delete');
    Route::get('halls/{hall}/delete', [HallController::class, 'delete'])->name('halls.delete');
    Route::get('seat_types/{seat_type}/delete', [SeatTypeController::class, 'delete'])->name('seat_types.delete');


    Route::resource('languages', LanguageController::class);
    Route::resource('countries', CountryController::class);
    Route::resource('classifications', ClassificationController::class);
    Route::resource('genres', GenreController::class);
    Route::resource('hall_types', HallTypeController::class);
    Route::resource('screen_types', ScreenTypeController::class);
    Route::resource('movies', MovieController::class);
    Route::resource('halls', HallController::class);
    Route::resource('seat_types', SeatTypeController::class);
});



