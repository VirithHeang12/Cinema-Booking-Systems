<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        return Inertia::render('Dashboard/Languages/Index');
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
        DB::beginTransaction();

        try {

            Language::create([
                'name' => $request->name,
                'code' => $request->code,
            ]);

            DB::commit();

            return redirect()->route('dashboard.languages.index')->with('success', 'Language created.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.languages.index')->with('error', 'Language not created.');
        }
    }
}
