<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;



Route::middleware(['throttle:global'])->group(function () {
    Route::prefix(LaravelLocalization::setLocale())->middleware([ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ])->group(function() {
        require_once __DIR__.'/dashboard.php';
        require_once __DIR__.'/auth.php';
        require_once __DIR__.'/information.php';

        Route::get('/', function () {
            return Inertia::render('Index');
        })->name('index');
    });
});
