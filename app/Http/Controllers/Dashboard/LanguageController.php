<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class LanguageController extends Controller
{
    /**
     * Display a listing of languages.
     *
     * @return \Inertia\Response
     */
    public function index(): \Inertia\Response
    {
        $languages = Language::all();

        return Inertia::render('Dashboard/Languages/Index', [
            'languages'     => $languages,
        ]);
    }

    /**
     * Show the form for creating a new language.
     *
     * @return \Inertia\Response
     *
     */
    public function create(): \Inertia\Response
    {
        return Inertia::render('Dashboard/Languages/Create');
    }

    /**
     * Store a newly created language in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name'          => 'required|string',
            'code'          => 'required|string',
            'attachment'    => 'nullable|file|mimes:jpg,png,jpeg|max:2048',
        ]);

        DB::beginTransaction();

        try {

            if ($request->hasFile('attachment')) {

                $attachment = $request->file('attachment');

                $attachmentName = time() . '.' . $attachment->getClientOriginalExtension();

                $attachment->move(storage_path('app/public/attachments'), $attachmentName);
            }

            Language::create([
                'name'              => $request->name,
                'code'              => $request->code,
                'attachment_url'    => $attachmentName,
            ]);

            DB::commit();

            return redirect()->route('dashboard.languages.index')->with('success', 'Language created.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.languages.index')->with('error', 'Language not created.');
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
        return Inertia::render('Dashboard/Languages/Show', [
            'language'      => $language,
        ]);
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
        return Inertia::render('Dashboard/Languages/Edit', [
            'language'      => $language,
        ]);
    }

    /**
     * Update the specified language in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Language  $language
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Language $language): \Illuminate\Http\RedirectResponse
    {
        DB::beginTransaction();

        try {

            $language->update([
                'name' => $request->name,
                'code' => $request->code,
            ]);

            DB::commit();

            return redirect()->route('dashboard.languages.index')->with('success', 'Language updated.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.languages.index')->with('error', 'Language not updated.');
        }
    }

    /**
     * Show the form for deleting the specified language.
     *
     * @param  \App\Models\Language  $language
     *
     * @return \Inertia\Response
     */
    public function delete(Language $language): \Inertia\Response
    {
        return Inertia::render('Dashboard/Languages/Delete', [
            'language'      => $language,
        ]);
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

            $files = Storage::files(public_path('storage/attachments'));



            // // delete attachment
            // if ($language->attachment_url) {
            //     if (Storage::exists('public/attachments/1738678875.png')) {
            //         dd('here');
            //         Storage::delete('attachments/' . $language->attachment_url);
            //     }
            // }
            dd('here1');
            $language->delete();

            DB::commit();

            return redirect()->route('dashboard.languages.index')->with('success', 'Language deleted.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.languages.index')->with('error', 'Language not deleted.');
        }
    }
}
