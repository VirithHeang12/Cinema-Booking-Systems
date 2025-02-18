<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Spatie\QueryBuilder\QueryBuilder;

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
            ->with(['movieGenres', 'Movie', 'classification', 'screenType', 'language', 'country'])
            ->paginate($perPage)
            ->appends(request()->query());

        return Inertia::render('Dashboard/Movies/Index', [
            'movies'     => $movies,
        ]);
    }

    /**
     * Show the form for creating a new Movie.
     *
     * @return \Inertia\Response
     *
     */
    public function create(): \Inertia\Response
    {
        return Inertia::render('Dashboard/Movies/Create');
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

            Movie::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            DB::commit();

            return redirect()->route('dashboard.hall_types.index')->with('success', 'Movie created.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.hall_types.index')->with('error', 'Movie not created.');
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
