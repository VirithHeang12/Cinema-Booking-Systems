<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\HallTypeResource;
use App\Http\Resources\HallResource;
use App\Models\Hall;
use App\Models\HallType;
use App\Models\Movie;
use App\Models\MovieGenre;
use App\Models\MovieSubtitle;
use App\Models\SeatType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;
use InertiaUI\Modal\Modal;

class HallController extends Controller
{
    /**
     * Display a listing of Halls.
     *
     * @return \Inertia\Response
     */
    public function index(): \Inertia\Response
    {
        Gate::authorize('viewAny', Hall::class);

        $perPage = request()->query('itemsPerPage', 10);

        $halls = QueryBuilder::for(Hall::class)
            ->allowedFilters([
                AllowedFilter::callback('search', function ($query, $value) {
                    $query->where('name', 'like', "%{$value}%")
                        ->orWhere('description', 'like', "%{$value}%");
                }),
                AllowedFilter::callback('hall_type', function ($query, $value) {
                    $query->whereHas('hallType', function ($q) use ($value) {
                        $q->where('name', $value);
                    });
                }),
            ])
            ->allowedSorts(
                AllowedSort::callback('seats_count', function ($query, $descending) {
                    $direction = $descending ? 'desc' : 'asc';
                    $query->withCount('seats')->orderBy('seats_count', $direction);
                }),
                AllowedSort::field('name'),
            )
            ->with(['hallType', 'seats', 'hallSeatTypes'])
            ->withCount('seats')
            ->paginate($perPage)
            ->appends(request()->query());

        $halls = HallResource::collection($halls)->response()->getData(true);

        return Inertia::render('Dashboard/Halls/Index', [
            'halls'         => $halls,
        ]);
    }

    /**
     * Show the form for creating a new Movie.
     *
     * @return Modal
     */
    public function create(): Modal
    {
        Gate::authorize('create', Movie::class);

        $hallTypes = HallTypeResource::collection(HallType::all())->response()->getData(true);
        $seatTypes = SeatTypeResource::collection(SeatType::all())->response()->getData(true);

        return Inertia::modal('Dashboard/Halls/Create', [

        ]);
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
