<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\User\LandingPageController;
use App\Http\Middleware\RedirectIfAdmin;
use App\Models\Movie;
use App\Models\Show;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\QueryBuilder\QueryBuilder;

Route::middleware(['throttle:global'])->group(function () {
    Route::prefix(LaravelLocalization::setLocale())->middleware([ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ])->group(function() {
        require_once __DIR__.'/dashboard.php';
        require_once __DIR__.'/auth.php';

        Route::middleware(RedirectIfAdmin::class)->group(function () {
            require_once __DIR__.'/information.php';

            Route::get('/', LandingPageController::class)->name('index');

            Route::prefix('/shows/{show}')->name('shows.')->group(function () {
                Route::middleware('auth')->group(function () {
                    Route::get('/booking', [BookingController::class, 'show'])
                        ->name('booking.show');
                    Route::post('/booking', [BookingController::class, 'store'])
                        ->name('booking.store');
                    Route::get('/booking/tickets', [BookingController::class, 'tickets'])
                        ->name('booking.tickets');
                });
            });

            Route::middleware('auth')->group(function () {
                Route::get('/booking/tickets', [BookingController::class, 'tickets'])
                    ->name('booking.tickets');
                });

            Route::get('/movies/{movie}/details', function (Movie $movie) {
                $movie->load(['movieGenres.genre', 'movieSubtitles.language', 'classification']);

                $subtitleIds = $movie->movieSubtitles->pluck('id');

                $shows = QueryBuilder::for(Show::class)
                    ->allowedFilters([
                        'hall_id',
                    ])
                    ->with(['movieSubtitle.language', 'hall.hallType', 'screenType', 'showSeats'])
                    ->whereIn('movie_subtitle_id', $subtitleIds)
                    ->orderBy('show_time')
                    ->get();

                $showDates = $shows->pluck('show_time')->map(fn($time) => $time->toDateString())->unique()->values();

                return Inertia::render('Detail', [
                    'movie' => $movie,
                    'shows' => $shows,
                    'showDates' => $showDates,
                ]);
            })->name('movie-details');
        });


    });
});
