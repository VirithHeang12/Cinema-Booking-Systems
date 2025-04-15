<?php

use App\Http\Controllers\User\LandingPageController;
use App\Http\Middleware\RedirectIfAdmin;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;



Route::middleware(['throttle:global'])->group(function () {
    Route::prefix(LaravelLocalization::setLocale())->middleware([ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ])->group(function() {
        require_once __DIR__.'/dashboard.php';
        require_once __DIR__.'/auth.php';

        Route::middleware(RedirectIfAdmin::class)->group(function () {
            require_once __DIR__.'/information.php';

            Route::get('/', LandingPageController::class)->name('index');

            Route::get('/booking-ticket', function () {
                return Inertia::render('BookingTicket', ['title' => 'Booking Ticket']);
            })->name('bookingTicket');
        });
        
        Route::get('/movies/{id}', function ($id) {
            return Inertia::render('Detail', [
                'id' => $id,
            ]);
        })->name('movie-detail');
    });
});
