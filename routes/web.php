<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::prefix(LaravelLocalization::setLocale())->middleware([ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ])->group(function() {
    Route::get('/', function () {
        return Inertia::render('Index');
    })->name('index');

    Route::get('/about', function () {
        return Inertia::render('About');
    })->name('about');

    Route::get('/contact', function () {
        return Inertia::render('Contact');
    })->name('contact');

    Route::get('/users', function () {
        return Inertia::render('Create');
    })->name('users.create');

    Route::post('/users', function (Request $request) {
        return redirect()->route('index');
    })->name('users.store');
});

