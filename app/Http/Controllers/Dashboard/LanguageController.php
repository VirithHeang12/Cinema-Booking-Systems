<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\LanguageExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Languages\SaveRequest;
use App\Http\Requests\Languages\UpdateRequest;
use App\Imports\LanguagesImport;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use InertiaUI\Modal\Modal;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class LanguageController extends Controller
{
    /**
     * Display a listing of languages.
     *
     * @return \Inertia\Response
     */
    public function index(): \Inertia\Response
    {
        Gate::authorize('viewAny', Language::class);

        $perPage = request()->query('itemsPerPage', 5);
        $languages = QueryBuilder::for(Language::query())
        ->allowedFilters([
            AllowedFilter::callback('search', function ($query, $value) {
                $query->where('name', 'like', "%{$value}%")
                    ->orWhere('code', 'like', "%{$value}%");
            }),
        ])
        ->allowedSorts(['name', 'code', 'created_at', 'updated_at'])
            ->paginate($perPage);

        // $languages = Language::paginate($perPage)->appends(request()->query());


        return Inertia::render('Dashboard/Languages/Index', [
            'languages'     => $languages
        ]);
    }

    /**
     * Show the form for creating a new language.
     *
     * @return Modal
     *
     */
    public function create(): Modal
    {
        Gate::authorize('create', Language::class);

        return Inertia::modal('Dashboard/Languages/Create')
            ->baseRoute('dashboard.languages.index');
    }

    /**
     * Store a newly created language in storage.
     *
     * @param  \App\Http\Requests\Languages\SaveRequest  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SaveRequest $request): \Illuminate\Http\RedirectResponse
    {
        Gate::authorize('create', Language::class);

        DB::beginTransaction();

        try {

            $data = $request->validated();

            Language::create([
                'name'          => $data['name'],
                'code'          => $data['code'],
            ]);

            DB::commit();

            return redirect()->route('dashboard.languages.index')->with('success', __('Language created.'));
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.languages.index')->with('error', __('Language not created.'));
        }
    }

    /**
     * Display the specified language.
     *
     * @param  \App\Models\Language  $language
     *
     * @return \Inertia\Response
     */
    public function show(Language $language): Modal
    {
        Gate::authorize('view', $language);

        return Inertia::modal('Dashboard/Languages/Show', [
            'language'      => $language,
        ])->baseRoute('dashboard.languages.index');
    }

    /**
     * Show the form for editing the specified language.
     *
     * @param  \App\Models\Language  $language
     *
     * @return Modal
     */
    public function edit(Language $language)
    {
        Gate::authorize('update', $language);

        return Inertia::modal('Dashboard/Languages/Edit', [
            'language'      => $language,
        ])->baseRoute('dashboard.languages.index');
    }

    /**
     * Update the specified language in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Language  $language
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, Language $language): \Illuminate\Http\RedirectResponse
    {
        Gate::authorize('update', $language);

        DB::beginTransaction();

        try {

            $data = $request->validated();

            $language->update([
                'name'          => $data['name'],
                'code'          => $data['code'],
            ]);

            DB::commit();

            return redirect()->route('dashboard.languages.index')->with('success', __('Language updated.'));
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.languages.index')->with('error', __('Language not updated.'));
        }
    }

    /**
     * Show the form for deleting the specified language.
     *
     * @param  \App\Models\Language  $language
     *
     * @return Modal
     */
    public function delete(Language $language): Modal
    {
        Gate::authorize('delete', $language);

        return Inertia::modal('Dashboard/Languages/Delete', [
            'language'      => $language,
        ])->baseRoute('dashboard.languages.index');
    }

    /**
     * Remove the specified language from storage.
     *
     * @param  \App\Models\Language  $language
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Language $language): \Illuminate\Http\RedirectResponse
    {
        Gate::authorize('delete', $language);
        DB::beginTransaction();

        try {

            $language->delete();

            DB::commit();

            return redirect()->route('dashboard.languages.index')->with('success', __('Language deleted.'));
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.languages.index')->with('error', __('Language not deleted.'));
        }
    }
    /**
     * Show the form for importing languages.
     *
     * @return \Inertia\Response
     */
  public function showImport():Modal{
    

    Gate::authorize('import', Language::class);

    return Inertia::modal('Dashboard/Languages/Import')->baseRoute('dashboard.languages.index');
  }

    /**
     * Import languages from an Excel file.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(Request $request): \Illuminate\Http\RedirectResponse
    {
        Gate::authorize('import', Language::class);

        DB::beginTransaction();

        try {
            Excel::import(new LanguagesImport, $request->file('file'));
            DB::commit();

            return redirect()->route('dashboard.languages.index')->with('success', 'Language imported.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('dashboard.languages.index')->with('error', $e->getMessage());
        }
    }
    /**
     * Export languages to an Excel file.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        Gate::authorize('export', Language::class);

        return Excel::download(new LanguageExport(), 'languages.xlsx');
    }
}
