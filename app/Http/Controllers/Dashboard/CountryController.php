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

    /**
     * Update a country
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Country $country): \Illuminate\Http\RedirectResponse{
        DB::beginTransaction();

        try {

            $country->update([
                'name' => $request->name,
            ]);

            DB::commit();

            return redirect()->route('dashboard.countries.index')->with('success', 'Country updated.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.countries.edit', $country->id)->with('error', 'Country not updated.');
        }
    }

    /**
     * Remove the specified country from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\RedirectResponse
     *
     *
     */
    public function destroy(Country $country): \Illuminate\Http\RedirectResponse{
        DB::beginTransaction();

        try {

            $country->delete();

            DB::commit();

            return redirect()->route('dashboard.countries.index')->with('success', 'Country deleted.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.countries.index')->with('error', 'Country not deleted.');
        }
    }

    

}
