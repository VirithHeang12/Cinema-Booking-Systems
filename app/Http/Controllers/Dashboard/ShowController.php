<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shows\StoreRequest;
use App\Http\Requests\Shows\UpdateRequest;
use App\Models\Hall;
use App\Models\Movie;
use App\Models\MovieSubtitle;
use App\Models\ScreenType;
use App\Models\Show;
use Inertia\Inertia;
use InertiaUI\Modal\Modal;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class ShowController extends Controller
{

public function create(): Modal
{
    Gate::authorize('create', Show::class);

    $movieSubtitleId = request()->input('movieSubtitleId');

    if (!$movieSubtitleId) {
        // If movieSubtitleId is not provided, return an error response.
        abort(400, 'Movie ID is required to create a show.');
    }

    $movieSubtitle = MovieSubtitle::findOrFail($movieSubtitleId);
    $movie = Movie::findOrFail($movieSubtitle->movie_id);
    $movieSubtitles = MovieSubtitle::with('movie', 'language')
    ->where('movie_id', $movie->id)
    ->get()
    ->map(function ($ms) {
        $languageName = $ms->language ? $ms->language->name : 'Original';
        return [
            'id' => $ms->id,
            'label' =>  $languageName,
        ];
    });

        // dd($movieSubtitles);

    $halls = Hall::all()->map(fn ($hall) => ['id' => $hall->id, 'label' => $hall->name]);
    $screenTypes = ScreenType::all()->map(fn ($st) => ['id' => $st->id, 'label' => $st->name]);

    return Inertia::modal('Dashboard/Shows/Create', [
        'movieSubtitles' => $movieSubtitles,
        'halls' => $halls,
        'screenTypes' => $screenTypes,
        'movieId' => $movie->id,
    ])->baseRoute('dashboard.movies.show', ['movie' => $movie->id]);
}



    /**
     * Store a newly created resource in storage.
    **/
public function store(StoreRequest $request): \Illuminate\Http\RedirectResponse
{
    Gate::authorize('create', Show::class);

    DB::beginTransaction();

    try {
        $data = $request->validated();

        $show = Show::create([
            'movie_subtitle_id' => $data['movie_subtitle_id'] ?? null,
            'hall_id' => $data['hall_id'],
            'screen_type_id' => $data['screen_type_id'],
            'show_time' => $data['show_time'],
            'status' => $data['status'] ?? 'scheduled',
        ]);

        DB::commit();

        $movieSubtitle = MovieSubtitle::find($data['movie_subtitle_id']);
        $movieId = $movieSubtitle->movie_id;

        return redirect()->route('dashboard.movies.show', ['movie' => $movieId])
            ->with('success', __('Show created successfully.'));

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Error creating show: ' . $e->getMessage());
        $movieId = $movieSubtitle->movie_id ?? null;
        return redirect()->route('dashboard.movies.show', ['movie' => $movieId])
            ->with('error', __('Failed to create show. Please try again.'));
    }
}


}
