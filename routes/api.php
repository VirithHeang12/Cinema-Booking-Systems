<?php

use App\Http\Controllers\Api\V1\Dashboard\LanguageController;
use App\Http\Controllers\Api\V1\Dashboard\HallTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::apiResource('languages', LanguageController::class);
    });

    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::apiResource('hall_types', HallTypeController::class);
    });
})->middleware('auth:sanctum');

