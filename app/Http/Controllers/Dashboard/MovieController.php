<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Classifications\SaveRequest;
use App\Http\Resources\Api\ClassificationResource;
use App\Http\Resources\Api\CountryResource;
use App\Http\Resources\Api\GenreResource;
use App\Http\Resources\Api\LanguageResource;
use App\Models\Classification;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Language;
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
        $genres = GenreResource::collection(Genre::all())->toArray(request());
        $countries = CountryResource::collection(Country::all())->toArray(request());
        $classifications = ClassificationResource::collection(Classification::all())->toArray(request());
        $languages = LanguageResource::collection(Language::all())->toArray(request());

        return Inertia::modal('Dashboard/Movies/Create', [
            'genres'                => $genres,
            'countries'             => $countries,
            'classifications'       => $classifications,
            'languages'             => $languages,
        ])->baseRoute('dashboard.movies.index');
    }

    /**
     * Store a newly created Movie in storage.
     *
     * @param  SaveRequest  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SaveRequest $request): \Illuminate\Http\RedirectResponse
    {
        DB::beginTransaction();

        try {

            $data = $request->validated();

            $movie = Movie::create([
                'title'                     => $data['title'],
                'description'               => $data['description'],
                'release_date'              => $data['release_date'],
                'duration'                  => $data['duration'],
                'rating'                    => $data['rating'],
                'trailer_url'               => $data['trailer_url'],
                'thumbnail_url'             => $data['thumbnail_url'],
                'country_id'                => $data['country_id'],
                'classification_id'         => $data['classification_id'],
                'spoken_language_id'        => $data['spoken_language_id'],
            ]);

            foreach ($data['movieGenres'] as $genre) {
                MovieGenre::create([
                    'movie_id'      => $movie->id,
                    'genre_id'      => $genre,
                ]);
            }
            foreach ($data['movieSubtitles'] as $subtitle) {
                MovieSubtitle::create([
                    'movie_id'      => $movie->id,
                    'language_id'   => $subtitle,
                ]);
            }

            DB::commit();

            return redirect()->route('dashboard.movies.index')->with('success', 'Movie created.');
        } catch (\Exception $e) {
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
