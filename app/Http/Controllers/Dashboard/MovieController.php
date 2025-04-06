<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\MoviesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Movies\ImportMoviesRequest;
use App\Http\Requests\Movies\SaveRequest;
use App\Http\Requests\Movies\UpdateRequest;
use App\Http\Resources\Api\ClassificationResource;
use App\Http\Resources\Api\CountryResource;
use App\Http\Resources\Api\GenreResource;
use App\Http\Resources\Api\LanguageResource;
use App\Http\Resources\MovieResource;
use App\Imports\MoviesImport;
use App\Models\Classification;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Language;
use App\Models\Movie;
use App\Models\MovieGenre;
use App\Models\MovieSubtitle;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Spatie\QueryBuilder\QueryBuilder;
use InertiaUI\Modal\Modal;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\QueryBuilder\AllowedFilter;

class MovieController extends Controller
{
    /**
     * Display a listing of Movies.
     *
     * @return \Inertia\Response
     */
    public function index(): \Inertia\Response
    {
        Gate::authorize('viewAny', Movie::class);

        $perPage = request()->query('itemsPerPage', 10);

        $movies = QueryBuilder::for(Movie::class)
            ->allowedFilters([
                AllowedFilter::callback('search', function ($query, $value) {
                    $query->where('title', 'like', "%{$value}%")
                        ->orWhere('description', 'like', "%{$value}%");
                }),
                AllowedFilter::callback('country', function ($query, $value) {
                    $query->whereHas('country', function ($q) use ($value) {
                        $q->where('name', $value);
                    });
                }),
                AllowedFilter::callback('classification', function ($query, $value) {
                    $query->whereHas('classification', function ($q) use ($value) {
                        $q->where('name', $value);
                    });
                }),
                AllowedFilter::callback('year', function ($query, $value) {
                    $query->whereYear('release_date', $value);
                }),
            ])
            ->allowedSorts(
                'title',
                'release_date',
                'duration',
            )
            ->with(['movieGenres', 'country', 'classification', 'language', 'movieSubtitles'])
            ->paginate($perPage)
            ->appends(request()->query());

        $movies = MovieResource::collection($movies)->response()->getData(true);

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
        Gate::authorize('create', Movie::class);

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
        Gate::authorize('create', Movie::class);

        DB::beginTransaction();

        try {

            $data = $request->validated();

            if ($request->hasFile('thumbnail_file')) {
                $data['thumbnail_url'] = $request->file('thumbnail_file')->store('movies');
            }

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
                    'genre_id'      => $genre['id'],
                ]);
            }
            foreach ($data['movieSubtitles'] as $subtitle) {
                MovieSubtitle::create([
                    'movie_id'      => $movie->id,
                    'language_id'   => $subtitle['id'],
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
     * @return Modal
     */
    public function show(Movie $movie): Modal
    {
        Gate::authorize('view', $movie);

        $genres             = GenreResource::collection(Genre::all())->toArray(request());
        $countries          = CountryResource::collection(Country::all())->toArray(request());
        $classifications    = ClassificationResource::collection(Classification::all())->toArray(request());
        $languages          = LanguageResource::collection(Language::all())->toArray(request());

        $movie->load(['movieGenres', 'movieSubtitles', 'movieGenres.genre', 'movieSubtitles.language']);

        $movie->movieGenres = $movie->movieGenres->map(function ($genre) {
            return [
                'id'            => $genre->genre->id,
                'name'          => $genre->genre->name,
            ];
        });

        $movie->movieSubtitles = $movie->movieSubtitles->map(function ($subtitle) {
            return [
                'id'            => $subtitle->language->id,
                'name'          => $subtitle->language->name,
            ];
        });

        $movie->thumbnail_url = Storage::temporaryUrl(
            $movie->thumbnail_url,
            now()->addMinutes(5),
        );

        return Inertia::modal('Dashboard/Movies/Show', [
            'movie'                 => $movie->load(['movieGenres', 'movieSubtitles']),
            'genres'                => $genres,
            'countries'             => $countries,
            'classifications'       => $classifications,
            'languages'             => $languages,
        ])->baseRoute('dashboard.movies.index');
    }

    /**
     * Show the form for editing the specified Movie.
     *
     * @param  \App\Models\Movie  $movie
     *
     * @return Modal
     */
    public function edit(Movie $movie): Modal
    {
        Gate::authorize('update', $movie);

        $genres             = GenreResource::collection(Genre::all())->toArray(request());
        $countries          = CountryResource::collection(Country::all())->toArray(request());
        $classifications    = ClassificationResource::collection(Classification::all())->toArray(request());
        $languages          = LanguageResource::collection(Language::all())->toArray(request());

        $movie->load(['movieGenres', 'movieSubtitles', 'movieGenres.genre', 'movieSubtitles.language']);

        $movie->movieGenres = $movie->movieGenres->map(function ($genre) {
            return [
                'id'            => $genre->genre->id,
                'name'          => $genre->genre->name,
            ];
        });

        $movie->movieSubtitles = $movie->movieSubtitles->map(function ($subtitle) {
            return [
                'id'            => $subtitle->language->id,
                'name'          => $subtitle->language->name,
            ];
        });

        $movie->thumbnail_url = Storage::temporaryUrl(
            $movie->thumbnail_url,
            now()->addMinutes(5),
        );

        return Inertia::modal('Dashboard/Movies/Edit', [
            'movie'                 => $movie->load(['movieGenres', 'movieSubtitles']),
            'genres'                => $genres,
            'countries'             => $countries,
            'classifications'       => $classifications,
            'languages'             => $languages,
        ])->baseRoute('dashboard.movies.index');
    }

    /**
     * Update the specified Movie in storage.
     *
     * @param  UpdateRequest  $request
     * @param  \App\Models\Movie  $Movie
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, Movie $movie): \Illuminate\Http\RedirectResponse
    {
        Gate::authorize('update', $movie);

        $data = $request->validated();

        DB::beginTransaction();

        try {
            if ($request->hasFile('thumbnail_file')) {
                $data['thumbnail_url'] = $request->file('thumbnail_file')->store('movies');
            }

            if ($movie->thumbnail_url && $request->hasFile('thumbnail_file')) {
                Storage::delete($movie->thumbnail_url);
            }

            if ($movie->thumbnail_url && !$request->hasFile('thumbnail_file')) {
                $data['thumbnail_url'] = $movie->thumbnail_url;
            }

            $movie->update([
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

            $movie->movieGenres()->delete();
            $movie->movieSubtitles()->delete();

            foreach ($data['movieGenres'] as $genre) {
                MovieGenre::create([
                    'movie_id'      => $movie->id,
                    'genre_id'      => $genre['id'],
                ]);
            }

            foreach ($data['movieSubtitles'] as $subtitle) {
                MovieSubtitle::create([
                    'movie_id'      => $movie->id,
                    'language_id'   => $subtitle['id'],
                ]);
            }

            DB::commit();

            return redirect()->route('dashboard.movies.index')->with('success', 'Movie updated.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.movies.index')->with('error', 'Movie not updated.');
        }
    }

    /**
     * Show the form for deleting the specified Movie.
     *
     * @param  \App\Models\Movie  $Movie
     *
     * @return Modal
     */
    public function delete(Movie $movie): Modal
    {
        Gate::authorize('delete', $movie);

        return Inertia::modal('Dashboard/Movies/Delete', [
            'movie'      => $movie,
        ])->baseRoute('dashboard.movies.index');
    }

    /**
     * Remove the specified Movie from storage.
     *
     * @param  \App\Models\Movie  $Movie
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Movie $movie): \Illuminate\Http\RedirectResponse
    {
        Gate::authorize('delete', $movie);

        DB::beginTransaction();

        try {
            $movie->delete();

            DB::commit();

            return redirect()->route('dashboard.movies.index')->with('success', 'Movie deleted.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.movies.index')->with('error', 'Movie not deleted.');
        }
    }

    /**
     * Show import movies form.
     *
     * @return Modal
     */
    public function showImport(): Modal
    {
        Gate::authorize('import', Movie::class);

        return Inertia::modal('Dashboard/Movies/Import')->baseRoute('dashboard.movies.index');
    }

    /**
     * Import movies from excel file.
     *
     * @param  ImportMoviesRequest  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(ImportMoviesRequest $request): \Illuminate\Http\RedirectResponse
    {
        Gate::authorize('import', Movie::class);

        DB::beginTransaction();

        try {
            Excel::import(new MoviesImport, $request->file('file'));
            DB::commit();

            return redirect()->route('dashboard.movies.index')->with('success', 'Movies imported.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('dashboard.movies.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Show export movies form.
     *
     * @return Modal
     */
    public function export()
    {
        Gate::authorize('export', Movie::class);

        return Excel::download(new MoviesExport, 'movies.xlsx');
    }
}
