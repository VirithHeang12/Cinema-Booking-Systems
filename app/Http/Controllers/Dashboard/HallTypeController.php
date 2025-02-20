<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\HallType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\HallTypesImport;
use App\Exports\HallTypesExport;

class HallTypeController extends Controller
{
    /**
     * Display a listing of HallTypes.
     *
     * @return \Inertia\Response
     */
    public function index(): \Inertia\Response
    {
        $perPage = request()->query('itemsPerPage', 5);
        $hall_types = HallType::paginate($perPage)->appends(request()->query());

        return Inertia::render('Dashboard/HallTypes/Index', [
            'hall_types'     => $hall_types,
        ]);
    }

    /**
     * Show the form for creating a new HallType.
     *
     * @return \Inertia\Response
     *
     */
    public function create(): \Inertia\Response
    {
        return Inertia::render('Dashboard/HallTypes/Create');
    }

    /**
     * Store a newly created HallType in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        DB::beginTransaction();

        try {

            HallType::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            DB::commit();

            return redirect()->route('dashboard.hall_types.index')->with('success', 'HallType created.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.hall_types.index')->with('error', 'HallType not created.');
        }
    }

    /**
     * Display the specified halltype.
     *
     * @param  \App\Models\HallType  $halltype
     *
     * @return \Inertia\Response
     */
    public function show(HallType $hall_type): \Inertia\Response
    {
        return Inertia::render('Dashboard/HallTypes/Show', [
            'hall_type'      => $hall_type,
        ]);
    }

    /**
     * Show the form for editing the specified halltype.
     *
     * @param  \App\Models\HallType  $halltype
     *
     * @return \Inertia\Response
     */
    public function edit(HallType $hall_type): \Inertia\Response
    {
        return Inertia::render('Dashboard/HallTypes/Edit', [
            'hall_type'      => $hall_type,
        ]);
    }

    /**
     * Update the specified halltype in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HallType  $halltype
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, HallType $hall_type): \Illuminate\Http\RedirectResponse
    {
        DB::beginTransaction();

        try {

            $hall_type->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            DB::commit();

            return redirect()->route('dashboard.hall_types.index')->with('success', 'HallType updated.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.hall_types.index')->with('error', 'HallType not updated.');
        }
    }

    /**
     * Show the form for deleting the specified halltype.
     *
     * @param  \App\Models\HallType  $halltype
     *
     * @return \Inertia\Response
     */
    public function delete(HallType $hall_type): \Inertia\Response
    {
        return Inertia::render('Dashboard/HallTypes/Delete', [
            'hall_type'      => $hall_type,
        ]);
    }

    /**
     * Remove the specified halltype from storage.
     *
     * @param  \App\Models\HallType  $halltype
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(HallType $hall_type): \Illuminate\Http\RedirectResponse
    {
        DB::beginTransaction();

        try {

            $hall_type->delete();

            DB::commit();

            return redirect()->route('dashboard.hall_types.index')->with('success', 'HallType deleted.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.hall_types.index')->with('error', 'HallType not deleted.');
        }
    }

    /**
     * Show Import hallType form.
     * @return \Inertia\Response
     */
    public function showImport(){
        return Inertia::render('Dashboard/HallTypes/Import');
    }

    /**
     * Import hallType from excel file.
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
            Excel::import(new HallTypesImport, $request->file('file'));
            DB::commit();

            return redirect()->route('dashboard.hall_types.index')->with('success', 'HallType imported.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('dashboard.hall_types.index')->with('error', $e->getMessage());
        }
    }

    public function export()
    {
        return Excel::download(new HallTypesExport, 'hall_types.xlsx');
    }
}
