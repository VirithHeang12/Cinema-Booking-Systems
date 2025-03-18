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
use App\Http\Requests\Countries\SaveRequest;
use App\Http\Requests\Countries\UpdateRequest;
use InertiaUI\Modal\Modal;

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
     * Show the form for creating a new Country.
     *
     * @return Modal
     *
     */
    public function create(): Modal
    {
        return Inertia::modal('Dashboard/Countries/Create')->baseRoute('dashboard.countries.index');
    }


    /**
     * Store a newly created country in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SaveRequest $request): \Illuminate\Http\RedirectResponse
    {
        DB::beginTransaction();

        try {

            $data = $request->validated();
            Country::create([
                'name' => $data['name'],
            ]);

            DB::commit();

            return redirect()->route('dashboard.countries.index')->with('success', 'Country created.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.countries.index')->with('error', 'Country not created.');
        }
    }

    /**
     * Show the form for editing a  Country.
     *
     * @return Modal
     *
     */
    public function edit(Country $country): Modal
    {
        return Inertia::modal('Dashboard/Countries/Edit', ['country' => $country])->baseRoute('dashboard.countries.index');
    }

    /**
     * Update a country
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Country  $country
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, Country $country): \Illuminate\Http\RedirectResponse
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            $country->update([
                'name' => $data['name']
            ]);

            DB::commit();

            return redirect()->route('dashboard.countries.index')->with('success', 'Country updated.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.countries.index')->with('error', 'Country not updated.');
        }
    }

    /**
     * Show a country
     *
     * @return Modal
     *
     *
     */
    public function show(Country $country): Modal
    {
        return Inertia::modal('Dashboard/Countries/Show', [
            'country'      => $country,
        ])->baseRoute('dashboard.countries.index');
    }
    /**
     * Show the form for deleting the specified country.
     *
     * @param  \App\Models\Country  $country
     * @return Modal
     */
    public function delete(Country $country): Modal
    {
        return Inertia::modal('Dashboard/Countries/Delete', [
            'country'      => $country,
        ])->baseRoute('dashboard.countries.index');
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
     * @return Modal
     */
    public function showImport(){
        return Inertia::modal('Dashboard/Countries/Import')->baseRoute('dashboard.countries.index');
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
