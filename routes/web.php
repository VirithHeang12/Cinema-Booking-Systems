<?php

use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::prefix(LaravelLocalization::setLocale())->middleware([ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ])->group(function() {
    require_once __DIR__.'/dashboard.php';

    Route::get('/', function () {
        $languages = Language::paginate(1);

        return Inertia::render('Index', [
            'languages' => $languages
        ]);
    })->name('index');

    Route::get('/about', function () {
        return Inertia::render('About', ['title' => 'About']);
    })->name('about');

    Route::get('/contact', function () {
        return Inertia::render('Contact', ['title' => 'Contact']);
    })->name('contact');

    Route::get('/users', function () {
        return Inertia::render('Create');
    })->name('users.create');

    Route::post('/users', function (Request $request) {
        return redirect()->route('index');
    })->name('users.store');

    Route::get('/locations', function () {
        return Inertia::render('Locations', ['title' => 'Locations']);
    })->name('locations');

    Route::get('/promotions', function () {
        return Inertia::render('Promotion', ['title' => 'Promotion']);
    })->name('promotions');

    Route::get('/privacy', function () {
        return Inertia::render('Privacy', ['title' => 'Privacy & Policy']);
    })->name('privacy');
    Route::get('/terms', function () {
        return Inertia::render('Terms', ['title' => 'Terms & Conditions']);
    })->name('terms');
});

