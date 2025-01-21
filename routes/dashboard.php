<?php

use App\Http\Controllers\Dashboard\LanguageController;
use Illuminate\Support\Facades\Route;

Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::resource('languages', LanguageController::class);
});
