<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Classification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ClassificationsImport;
use App\Exports\ClassificationsExport;
use InertiaUI\Modal\Modal;


class ClassificationController extends Controller
{
    /**
     * Display a listing of the classifications.
     *
     * @return \Inertia\Response
     */
    public function index(): \Inertia\Response
    {
        $perPage = request()->query('itemsPerPage', 5);
        $classifications = Classification::paginate($perPage)->appends(request()->query());
        return Inertia::render('Dashboard/Classifications/Index', [
            'classifications' => $classifications
        ]);
    }

    /**
     * Show the form for creating a new classification.
     *
     * @return Modal
     *
     */
    public function create(): Modal
    {
        return Inertia::modal('Dashboard/Classifications/Create')
            ->baseRoute('dashboard.classifications.index');
    }

    /**
     * Store a newly created classification in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        DB::beginTransaction();

        try {

            Classification::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            DB::commit();

            return redirect()->route('dashboard.classifications.index')->with('success', 'Classification created.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.classifications.index')->with('error', 'Classification not created.');
        }
    }

    /**
     * Display the specified classification.
     *
     * @param  \App\Models\Classification  $classification
     *
     * @return \Inertia\Response
     */
    public function show(Classification $classification): \Inertia\Response
    {
        return Inertia::render('Dashboard/Classifications/Show', ['classification' => $classification]);
    }

    /**
     * Show the form for editing the specified classification.
     *
     * @param  \App\Models\Classification  $classification
     *
     * @return Modal
     */
    public function edit(Classification $classification): Modal
    {
        return Inertia::modal('Dashboard/Classifications/Edit', [
            'classification' => $classification
        ])->baseRoute('dashboard.classifications.index');
    }

    /**
     * Update the specified classification in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Classification  $classification
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Classification $classification): \Illuminate\Http\RedirectResponse
    {
        DB::beginTransaction();

        try {

            $classification->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            DB::commit();

            return redirect()->route('dashboard.classifications.index')->with('success', 'Classification updated.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.classifications.index')->with('error', 'Classification is not updated.');
        }
    }

    /**
     * Show the form for deleting the specified classification.
     *
     * @param  \App\Models\Classification  $classification
     * @return \Inertia\Response
     */
    public function delete(Classification $classification): \Inertia\Response
    {
        return Inertia::render('Dashboard/Classifications/Delete', ['classification' => $classification]);
    }


    /**
     * Remove the specified classification from storage.
     *
     * @param  \App\Models\Classification  $classification
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Classification $classification): \Illuminate\Http\RedirectResponse
    {
        DB::beginTransaction();

        try {
            $classification->delete();

            DB::commit();

            return redirect()->route('dashboard.classifications.index')->with('success', 'Classification deleted.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.classifications.index')->with('error', 'Classification not deleted.');
        }
    }

    /**
     * Show Import classifications form.
     * @return \Inertia\Response
     */
    public function showImport()
    {
        return Inertia::render('Dashboard/Classifications/Import');
    }

    /**
     * Import classifications from excel file.
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
            Excel::import(new ClassificationsImport, $request->file('file'));
            DB::commit();

            return redirect()->route('dashboard.classifications.index')->with('success', 'Classifications imported.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('dashboard.classifications.index')->with('error', $e->getMessage());
        }
    }


    public function export()
    {
        return Excel::download(new ClassificationsExport, 'classifications.xlsx');
    }
}
