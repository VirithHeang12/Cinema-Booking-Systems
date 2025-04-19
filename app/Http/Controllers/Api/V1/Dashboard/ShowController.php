<?php

namespace App\Http\Controllers\Api\V1\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Show;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function index(Movie $movie)
    {
        $subtitles = $movie->movieSubtitles;
        $subtitleIds = $subtitles->pluck('id');
        $showTimes = Show::with(['movieSubtitle.language', 'hall.hallType', 'screenType', 'showSeats'])
            ->whereIn('movie_subtitle_id', $subtitleIds)
            ->orderBy('show_time')
            ->get();

        return response()->json($showTimes);
    }

    public function recent()
    {
        $shows = Show::with('movieSubtitle.movie')
            ->latest('show_time')
            ->take(6)
            ->get();

        return response()->json($shows);
    }

    public function getMovieShow(Request $request)
    {
        $date = $request->query('date');

        $shows = Show::with('movieSubtitle.movie.classification')
            ->whereDate('show_time', $date)
            ->get();

        return response()->json($shows);
    }
}

