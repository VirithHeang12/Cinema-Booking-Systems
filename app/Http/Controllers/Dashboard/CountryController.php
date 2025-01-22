<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CountryController extends Controller
{
    /**
     * Display a listing of countries.
     *
     * @return \Inertia\Response
     */
    public function index(): \Inertia\Response
    {
        $countries = Country::all();
        return Inertia::render('Dashboard/Countries/Index',
        ['countries' => $countries]);
    }

    /**
     * Show the form for creating a new country.
     *
     * @return \Inertia\Response
     *
     */
    public function create(): \Inertia\Response
    {
        return Inertia::render('Dashboard/Countries/Create');
    }
    /**
     * Store a newly created country in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        DB::beginTransaction();

        try {

            Country::create([
                'name' => $request->name,
            ]);

            DB::commit();

            return redirect()->route('dashboard.countries.index')->with('success', 'Country created.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.countries.index')->with('error', 'Country not created.');
        }
    }

    /**
     * Edit a country
     *
     *  @return \Inertia\Response
     */
    public function edit(Country $country): \Inertia\Response
    {
        return Inertia::render('Dashboard/Countries/Edit', ['country' => $country]);
    }

    
}
