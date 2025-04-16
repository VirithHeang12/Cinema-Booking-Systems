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

        if ($subtitles->isEmpty()) {
            return response()->json(['error' => 'No subtitles found for this movie'], 404);
        }
        $subtitle = $subtitles->first();
        $showTimes = Show::where('movie_subtitle_id', $subtitle->id)
            ->orderBy('show_time')
            ->get(['show_time', 'status']);
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
