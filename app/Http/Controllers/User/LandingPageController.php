<?php

namespace App\Http\Controllers\User;

use App\Actions\GetAllMoviesHavingShows;
use App\Actions\GetLatestDateRangeOf;
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
        $movies  = GetAllMoviesHavingShows::run();
        $days    = GetLatestDateRangeOf::run(4);

        return Inertia::render('Index', [
            'banners'       => $banners,
            'movies'        => $movies,
            'days'          => $days,
        ]);
    }
}
