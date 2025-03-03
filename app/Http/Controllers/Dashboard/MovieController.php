<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\MovieGenre;
use App\Models\MovieSubtitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Spatie\QueryBuilder\QueryBuilder;
use InertiaUI\Modal\Modal;

class MovieController extends Controller
{
    /**
     * Display a listing of Movies.
     *
     * @return \Inertia\Response
     */
    public function index(): \Inertia\Response
    {
        $perPage = request()->query('itemsPerPage', 5);

        $movies = QueryBuilder::for(Movie::class)
            ->with(['movieGenres'])
            ->paginate($perPage)
            ->appends(request()->query());

        return Inertia::render('Dashboard/Movies/Index', [
            'movies'     => $movies,
        ]);
    }

    /**
     * Show the form for creating a new Movie.
     *
     * @return Modal
     *
     */
    public function create(): Modal
    {
        return Inertia::modal('Dashboard/Movies/Create')->baseRoute('dashboard.movies.index');
    }

    /**
     * Store a newly created Movie in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        DB::beginTransaction();

        try {

            $movie = Movie::create([
                'title'                     => $request->title,
                'description'               => $request->description,
                'release_date'              => $request->release_date,
                'duration'                  => $request->duration,
                'rating'                    => $request->rating,
                'trailer_url'               => $request->trailer_url,
                'thumbnail_url'             => $request->thumbnail_url,
                'production_company_id'     => $request->production_company_id,
                'country_id'                => $request->country_id,
                'classification_id'         => $request->classification_id,
                'language_id'               => $request->language_id,
            ]);

            foreach ($request->movieGenres as $genre) {
                MovieGenre::create([
                    'movie_id' => $movie->id,
                    'genre_id' => $genre,
                ]);
            }

            foreach ($request->movieSubtitles as $subtitle) {
                MovieSubtitle::create([
                    'movie_id' => $movie->id,
                    'language_id' => $subtitle,
                ]);
            }

            DB::commit();

            return redirect()->route('dashboard.movies.index')->with('success', 'Movie created.');
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();

            return redirect()->route('dashboard.movies.index')->with('error', 'Movie not created.');
        }
    }

    /**
     * Display the specified Movie.
     *
     * @param  \App\Models\Movie  $Movie
     *
     * @return \Inertia\Response
     */
    public function show(Movie $hall_type): \Inertia\Response
    {
        return Inertia::render('Dashboard/Movies/Show', [
            'hall_type'      => $hall_type,
        ]);
    }

    /**
     * Show the form for editing the specified Movie.
     *
     * @param  \App\Models\Movie  $Movie
     *
     * @return \Inertia\Response
     */
    public function edit(Movie $hall_type): \Inertia\Response
    {
        return Inertia::render('Dashboard/Movies/Edit', [
            'hall_type'      => $hall_type,
        ]);
    }

    /**
     * Update the specified Movie in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $Movie
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Movie $hall_type): \Illuminate\Http\RedirectResponse
    {
        DB::beginTransaction();

        try {

            $hall_type->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            DB::commit();

            return redirect()->route('dashboard.hall_types.index')->with('success', 'Movie updated.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.hall_types.index')->with('error', 'Movie not updated.');
        }
    }

    /**
     * Show the form for deleting the specified Movie.
     *
     * @param  \App\Models\Movie  $Movie
     *
     * @return \Inertia\Response
     */
    public function delete(Movie $hall_type): \Inertia\Response
    {
        return Inertia::render('Dashboard/Movies/Delete', [
            'hall_type'      => $hall_type,
        ]);
    }

    /**
     * Remove the specified Movie from storage.
     *
     * @param  \App\Models\Movie  $Movie
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Movie $hall_type): \Illuminate\Http\RedirectResponse
    {
        DB::beginTransaction();

        try {

            $hall_type->delete();

            DB::commit();

            return redirect()->route('dashboard.hall_types.index')->with('success', 'Movie deleted.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.hall_types.index')->with('error', 'Movie not deleted.');
        }
    }
}
