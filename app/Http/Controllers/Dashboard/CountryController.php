<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CountriesImport;
use App\Exports\CountriesExport;

class CountryController extends Controller
{
    /**
     * Display a listing of countries.
     *
     * @return \Inertia\Response
     */
    public function index(): \Inertia\Response
    {
        $perPage = request()->query('itemsPerPage', 5);
        $countries = Country::paginate($perPage)->appends(request()->query());

        return Inertia::render('Dashboard/Countries/Index', [
            'countries' => $countries,
        ]);
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
     * @param  \App\Models\Country  $country
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Country $country): \Illuminate\Http\RedirectResponse
    {
        DB::beginTransaction();

        try {
            $country->update([
                'name' => $request->name,
            ]);

            DB::commit();

            return redirect()->route('dashboard.countries.index')->with('success', 'Country updated.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.countries.index')->with('error', 'Country not updated.');
        }
    }

    /**
     * Delete a country
     *
     * @param  \App\Models\Country  $country
     *
     * @return \Inertia\Response
     */
    public function show(Country $country): \Inertia\Response
    {
        return Inertia::render('Dashboard/Countries/Show', [
            'country'      => $country,
        ]);
    }
    /**
     * Show the form for deleting the specified country.
     *
     * @param  \App\Models\Country  $country
     * @return \Inertia\Response
     */
    public function delete(Country $country): \Inertia\Response
    {
        return Inertia::render('Dashboard/Countries/Delete', [
            'country'      => $country,
        ]);
    }
    /**
     * Remove the specified country from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function destroy(Country $country): \Illuminate\Http\RedirectResponse
    {
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

    /**
     * Show Import countries form.
     * @return \Inertia\Response
     */
    public function showImport(){
        return Inertia::render('Dashboard/Countries/Import');
    }

     /**
     * Import countries from excel file.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        DB::beginTransaction();

        try {
            Excel::import(new CountriesImport, $request->file('file'));
            DB::commit();

            return redirect()->route('dashboard.countries.index')->with('success', 'Countries imported.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('dashboard.countries.index')->with('error', $e->getMessage());
        }
    }

    public function export()
    {
        return Excel::download(new CountriesExport, 'countries.xlsx');
    }
}
