<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\ShowStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Shows\StoreRequest;
use App\Http\Requests\Shows\UpdateRequest;
use App\Http\Resources\Api\LanguageResource;
use App\Http\Resources\Api\ScreenTypeResource;
use App\Http\Resources\HallResource;
use App\Models\Hall;
use App\Models\Movie;
use App\Models\MovieSubtitle;
use App\Models\ScreenType;
use App\Models\Show;
use Inertia\Inertia;
use InertiaUI\Modal\Modal;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
class ShowController extends Controller
{
    /**
     * Display form for creating a new show.
     *
     * @param \App\Models\Movie $movie
     *
     * @return Modal
     */
    public function create(Movie $movie): Modal
    {
        Gate::authorize('create', Show::class);

        $halls          = HallResource::collection(Hall::all())->toArray(request());
        $screenTypes    = ScreenTypeResource::collection(ScreenType::all())->toArray(request());
        $languages      = collect(MovieSubtitle::where('movie_id', $movie->id)->with('language')->get())->map(
            function ($subtitle) {
                return LanguageResource::make($subtitle->language)->toArray(request());
            }
        );

        return Inertia::modal('Dashboard/Movies/Shows/Create', [
            'halls'         => $halls,
            'screen_types'  => $screenTypes,
            'languages'     => $languages,
            'movie'         => $movie,
        ])->baseRoute('dashboard.movies.show', [
            'movie'         => $movie,
        ]);
    }

    /**
     * Store a newly created show in storage.
     *
     * @param \App\Http\Requests\Shows\StoreRequest $request
     * @param \App\Models\Movie $movie
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request, Movie $movie): \Illuminate\Http\RedirectResponse
    {
        Gate::authorize('create', Show::class);

        DB::beginTransaction();

        try {
            $data = $request->validated();

            $movieSubtitle = MovieSubtitle::where('movie_id', $movie->id)
                ->where('language_id', $data['language_id'])
                ->first();

            Show::create([
                'movie_subtitle_id' => $movieSubtitle?->id,
                'hall_id'           => $data['hall_id'],
                'screen_type_id'    => $data['screen_type_id'],
                'show_time'         => $data['show_time'],
                'status'            => $data['status'] ?? ShowStatus::SCHEDULED,
            ]);

            DB::commit();

            return redirect()->route('dashboard.movies.show', [
                'movie'         => $movie
            ])->with('success', __('Show created successfully.'));
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.movies.show', [
                'movie'         => $movie
            ])->with('error', __('Failed to create show. Please try again.'));
        }
    }
}
