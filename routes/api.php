<?php


use App\Http\Controllers\Api\V1\Dashboard\GenreController;
use App\Http\Controllers\Api\V1\Dashboard\LanguageController;
use App\Http\Controllers\Api\V1\Dashboard\HallTypeController;
use App\Http\Controllers\Api\V1\Dashboard\CountryController;
use App\Http\Controllers\Api\V1\Dashboard\ClassificationController;
use App\Http\Controllers\Api\V1\Dashboard\ScreenTypeController;
use App\Http\Controllers\Api\V1\Dashboard\MovieController;
use App\Http\Controllers\Api\V1\Dashboard\BannerController;
use App\Http\Controllers\Api\V1\ShowSeatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::apiResource('languages', LanguageController::class);
        Route::apiResource('genres', GenreController::class);
        Route::apiResource('hall_types', HallTypeController::class);
        Route::apiResource('countries', CountryController::class);
        Route::apiResource('classifications', ClassificationController::class);
        Route::apiResource('screen_types', ScreenTypeController::class);
        Route::apiResource('movies', MovieController::class);
        Route::apiResource('banners', BannerController::class);
    });

    Route::get('/shows/{show}', [ShowSeatController::class, 'index']);
})->middleware('auth:sanctum');

