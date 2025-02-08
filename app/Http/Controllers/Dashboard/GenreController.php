<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class GenreController extends Controller
{
    /**
     * Display a listing of genres.
     *
     * @return \Inertia\Response
     */
    public function index(): \Inertia\Response
    {
        $genres = Genre::all();

        return Inertia::render('Dashboard/Genres/Index', [
            'genres'     => $genres,
        ]);
    }

    /**
     * Show the form for creating a new genre.
     *
     * @return \Inertia\Response
     *
     */
    public function create(): \Inertia\Response
    {
        return Inertia::render('Dashboard/Genres/Create');
    }

    /**
     * Store a newly created genre in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        DB::beginTransaction();

        try {

            Genre::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            DB::commit();

            return redirect()->route('dashboard.genres.index')->with('success', 'Genre created.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.genres.index')->with('error', 'Genre not created.');
        }
    }

    /**
     * Display the specified genre.
     *
     * @param  \App\Models\Genre  $genre
     *
     * @return \Inertia\Response
     */
    public function show(Genre $genre): \Inertia\Response
    {
        return Inertia::render('Dashboard/Genres/Show', [
            'genre'      => $genre,
        ]);
    }

    /**
     * Show the form for editing the specified genre.
     *
     * @param  \App\Models\Genre  $genre
     *
     * @return \Inertia\Response
     */
    public function edit(Genre $genre): \Inertia\Response
    {
        return Inertia::render('Dashboard/Genres/Edit', [
            'genre'      => $genre,
        ]);
    }

    /**
     * Update the specified genre in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Genre  $genre
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Genre $genre): \Illuminate\Http\RedirectResponse
    {
        DB::beginTransaction();

        try {

            $genre->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            DB::commit();

            return redirect()->route('dashboard.genres.index')->with('success', 'Genre updated.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.genres.index')->with('error', 'Genre not updated.');
        }
    }

    /**
     * Show the form for deleting the specified genre.
     *
     * @param  \App\Models\Genre  $genre
     *
     * @return \Inertia\Response
     */
    public function delete(Genre $genre): \Inertia\Response
    {
        return Inertia::render('Dashboard/Genres/Delete', [
            'genre'      => $genre,
        ]);
    }

    /**
     * Remove the specified genre from storage.
     *
     * @param  \App\Models\Genre  $genre
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Genre $genre): \Illuminate\Http\RedirectResponse
    {
        DB::beginTransaction();

        try {

            $genre->delete();

            DB::commit();

            return redirect()->route('dashboard.genres.index')->with('success', 'Genre deleted.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.genres.index')->with('error', 'Genre not deleted.');
        }
    }
}
