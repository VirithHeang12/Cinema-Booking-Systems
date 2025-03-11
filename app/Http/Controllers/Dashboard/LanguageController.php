<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Languages\SaveRequest;
use App\Http\Requests\Languages\UpdateRequest;
use App\Models\Language;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use InertiaUI\Modal\Modal;

class LanguageController extends Controller
{
    /**
     * Display a listing of languages.
     *
     * @return \Inertia\Response
     */
    public function index(): \Inertia\Response
    {
        $perPage = request()->query('itemsPerPage', 5);

        $languages = Language::paginate($perPage)->appends(request()->query());

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
    public function show(Language $language): \Inertia\Response
    {
        return Inertia::modal('Dashboard/Languages/Show', [
            'language'      => $language,
        ])->baseRoute('dashboard.languages.index');
    }

    /**
     * Show the form for editing the specified language.
     *
     * @param  \App\Models\Language  $language
     *
     * @return \Inertia\Response
     */
    public function edit(Language $language): \Inertia\Response
    {
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
}
