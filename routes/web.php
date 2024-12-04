<?php

use App\Http\Controllers\CarController;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Route::prefix('{locale}')->middleware(SetLocale::class)->group(function () {
//     Route::get('/', function () {
//         return view('test');
//     })->name('welcome');
// });

Route::get('/', function () {
    app()->setLocale('km');
        return view('test');
    })->name('welcome');

Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
