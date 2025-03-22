<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\GenresImport;
use App\Exports\GenresExport;
use InertiaUI\Modal\Modal;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Genres\SaveRequest;
use App\Http\Requests\Genres\UpdateRequest;

class GenreController extends Controller
{
    /**
     * Display a listing of genres.
     *
     * @return \Inertia\Response
     */
    public function index(): \Inertia\Response
    {
        Gate::authorize('viewAny', Genre::class);

        $perPage = request()->query('itemsPerPage', 5);
        $genres = Genre::paginate($perPage)->appends(request()->query());

        return Inertia::render('Dashboard/Genres/Index', [
            'genres'     => $genres,
        ]);
    }

    /**
     * Show the form for creating a new genre.
     *
     * @return Modal
     *
     */
    public function create(): Modal
    {
        Gate::authorize('create', Genre::class);

        return Inertia::modal('Dashboard/Genres/Create')
            ->baseRoute('dashboard.genres.index');
    }
    
    /**
     * Store a newly created genre in storage.
     *
     * @param  \Illuminate\Http\SaveRequest  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SaveRequest $request): \Illuminate\Http\RedirectResponse
    {
        Gate::authorize('create', Genre::class);
        DB::beginTransaction();

        try {

            $data = $request->validated();
            Genre::create([
                'name' => $data['name'],
                'description' => $data['description'],
            ]);
            
            DB::commit();
          
            return redirect()->route('dashboard.genres.index')->with('success', __('Genre created.'));
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.genres.index')->with('error', __('Genre not created.'));
        }
    }

    /**
     * Display the specified genre.
     *
     * @param  \App\Models\Genre  $genre
     *
     * @return Modal
     */
    public function show(Genre $genre): Modal
    {
        Gate::authorize('view', $genre);
        return Inertia::modal('Dashboard/Genres/Show', ['genre' => $genre])->baseRoute('dashboard.genres.index');
    }

    /**
     * Show the form for editing the specified genre.
     *
     * @param  \App\Models\Genre  $genre
     *
     * @return Modal
     */
    public function edit(Genre $genre): Modal
    {
        Gate::authorize('update', $genre);
        return Inertia::modal('Dashboard/Genres/Edit', ['genre' => $genre])->baseRoute('dashboard.genres.index');
    }

    /**
     * Update the specified genre in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Genre  $genre
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, Genre $genre): \Illuminate\Http\RedirectResponse
    {
        Gate::authorize('update', $genre);
        DB::beginTransaction();

        try {

            $data = $request->validated();
            $genre->update([
                'name' => $data['name'],
                'description' => $data['description'],
            ]);

            DB::commit();

            return redirect()->route('dashboard.genres.index')->with('success', __('Genre updated.'));
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.genres.index')->with('error', __('Genre not updated.'));
        }
    }

    /**
     * Show the form for deleting the specified genre.
     *
     * @param  \App\Models\Genre  $genre
     *
     * @return Modal
     */
    public function delete(Genre $genre): Modal
    {
        Gate::authorize('delete', $genre);
        return Inertia::modal('Dashboard/Genres/Delete', ['genre' => $genre])->baseRoute('dashboard.genres.index');
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
        Gate::authorize('delete', $genre);
        DB::beginTransaction();

        try {

            $genre->delete();

            DB::commit();

            return redirect()->route('dashboard.genres.index')->with('success', __('Genre deleted.'));
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.genres.index')->with('error', __('Genre not deleted.'));
        }
    }

       /**
     * Show Import Genres form.
     * @return \Inertia\Response
     */
    public function showImport(){
        Gate::authorize('import', Genre::class);
        return Inertia::render('Dashboard/Genres/Import');
    }

    /**
     * Import Genres from excel file.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(Request $request): \Illuminate\Http\RedirectResponse
    {
        Gate::authorize('import', Genre::class);
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        DB::beginTransaction();

        try {
            Excel::import(new GenresImport, $request->file('file'));
            DB::commit();

            return redirect()->route('dashboard.genres.index')->with('success', __('Genres imported.'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('dashboard.genres.index')->with('error', $e->getMessage());
        }
    }


    public function export()
    {
        Gate::authorize('export', Genre::class);
        return Excel::download(new GenresExport, 'genres.xlsx');
    }

}

