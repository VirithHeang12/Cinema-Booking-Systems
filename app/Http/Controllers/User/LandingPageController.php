<?php

namespace App\Http\Controllers\User;

use App\Actions\GetAllMoviesHavingShows;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\BannerResource;
use App\Models\Banner;
use Inertia\Inertia;

class LandingPageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $banners = BannerResource::collection(Banner::latest()->take(5)->get())->toArray(request());
        $movies  = app(GetAllMoviesHavingShows::class)->handle();

        return Inertia::render('Index', [
            'banners'       => $banners,
            'movies'        => $movies,
        ]);
    }
}
