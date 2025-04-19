<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Resources\Api\BannerResource;
use App\Models\Banner;

Route::get('/about', function () {
    return Inertia::render('About', ['title' => 'About']);
})->name('about');

Route::get('/contact', function () {
    return Inertia::render('Contact', ['title' => 'Contact']);
})->name('contact');

Route::get('/promotions', function () {
    $banners = BannerResource::collection(Banner::latest()->take(10)->get())->toArray(request());
    return Inertia::render('Promotion', ['title' => 'Promotion', 'banners' => $banners, ]);
})->name('promotions');

Route::get('/privacy', function () {
    return Inertia::render('Privacy', ['title' => 'Privacy & Policy']);
})->name('privacy');

Route::get('/terms', function () {
    return Inertia::render('Terms', ['title' => 'Terms & Conditions']);
})->name('terms');
