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
use App\Http\Requests\Countries\StoreRequest;
use App\Http\Requests\Countries\UpdateRequest;
use InertiaUI\Modal\Modal;
use Illuminate\Support\Facades\Gate;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Resources\Api\CountryResource;

class CountryController extends Controller
{
    /**
     * Display a listing of countries.
     *
     * @return \Inertia\Response
     */
    public function index(): \Inertia\Response
    {
        Gate::authorize('viewAny', Country::class);

        $perPage = request()->query('itemsPerPage', 5);

        $countriesQuery = QueryBuilder::for(Country::class)
            ->allowedFilters([
                AllowedFilter::callback('search', function ($query, $value) {
                    $query->where('name', 'like', "%{$value}%");
                }),
            ])
            ->allowedSorts('name');

        $countries = $countriesQuery->paginate($perPage)->appends(request()->query());

        $countries = CountryResource::collection($countries)->response()->getData(true);

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
        Gate::authorize('create', Country::class);

        return Inertia::modal('Dashboard/Countries/Create')
            ->baseRoute('dashboard.countries.index');
    }


    /**
     * Store a newly created country in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request): \Illuminate\Http\RedirectResponse
    {
        Gate::authorize('create', Country::class);

        DB::beginTransaction();

        try {

            $data = $request->validated();
            Country::create([
                'name' => $data['name'],
            ]);

            DB::commit();

            return redirect()->route('dashboard.countries.index')->with('success', __('Country created.'));
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.countries.index')->with('error', __('Country not created.'));
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
        Gate::authorize('update', $country);

        return Inertia::modal('Dashboard/Countries/Edit', [
            'country'       => $country
        ])
        ->baseRoute('dashboard.countries.index');
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
        Gate::authorize('update', $country);

        DB::beginTransaction();

        try {
            $data = $request->validated();

            $country->update([
                'name' => $data['name']
            ]);

            DB::commit();

            return redirect()->route('dashboard.countries.index')->with('success', __('Country updated.'));
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.countries.index')->with('error', __('Country not updated.'));
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
        Gate::authorize('view', $country);

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
        Gate::authorize('delete', $country);
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
        Gate::authorize('delete', arguments: $country);
        DB::beginTransaction();

        try {
            $country->delete();
            DB::commit();
            return redirect()->route('dashboard.countries.index')->with('success', __('Country deleted.'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('dashboard.countries.index')->with('error', __('Country not deleted.'));
        }
    }

    /**
     * Show Import countries form.
     * @return Modal
     */
    public function showImport()
    {
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
        Gate::authorize('import', Country::class);
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        DB::beginTransaction();

        try {
            Excel::import(new CountriesImport, $request->file('file'));
            DB::commit();

            return redirect()->route('dashboard.countries.index')->with('success', __('Countries imported.'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('dashboard.countries.index')->with('error', $e->getMessage());
        }
    }

    public function export()
    {
        Gate::authorize('export', Country::class);
        return Excel::download(new CountriesExport, 'countries.xlsx');
    }
}
