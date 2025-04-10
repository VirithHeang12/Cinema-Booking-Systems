<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/about', function () {
    return Inertia::render('About', ['title' => 'About']);
})->name('about');

Route::get('/contact', function () {
    return Inertia::render('Contact', ['title' => 'Contact']);
})->name('contact');

Route::get('/promotions', function () {
    return Inertia::render('Promotion', ['title' => 'Promotion']);
})->name('promotions');

Route::get('/privacy', function () {
    return Inertia::render('Privacy', ['title' => 'Privacy & Policy']);
})->name('privacy');

Route::get('/terms', function () {
    return Inertia::render('Terms', ['title' => 'Terms & Conditions']);
})->name('terms');
