<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\HallType;
use Illuminate\Http\Request;
use App\Http\Requests\HallTypes\SaveRequest;
use App\Http\Requests\HallTypes\UpdateRequest;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\HallTypesImport;
use App\Exports\HallTypesExport;
use InertiaUI\Modal\Modal;

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
     * @return Modal
     *
     */
    public function create(): Modal
    {
        return Inertia::modal('Dashboard/HallTypes/Create')
            ->baseRoute('dashboard.hall_types.index');
    }

    /**
     * Store a newly created HallType in storage.
     *
     * @param  \Illuminate\Http\SaveRequest  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SaveRequest $request): \Illuminate\Http\RedirectResponse
    {
        DB::beginTransaction();

        try {

            $data = $request->validated();

            HallType::create([
                'name'          => $data['name'],
                'description'   => $data['description'],
            ]);

            DB::commit();

            return redirect()->route('dashboard.hall_types.index')->with('success', __('HallType created.'));
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.hall_types.index')->with('error', __('HallType not created.'));
        }
    }

    /**
     * Display the specified halltype.
     *
     * @param  \App\Models\HallType  $halltype
     *
     * @return Modal
     */
    public function show(HallType $hall_type): Modal
    {
        return Inertia::modal('Dashboard/HallTypes/Show', [
            'hall_type'      => $hall_type,
        ])->baseRoute('dashboard.hall_types.index');
    }

    /**
     * Show the form for editing the specified halltype.
     *
     * @param  \App\Models\HallType  $halltype
     *
     * @return Modal
     */
    public function edit(HallType $hall_type): Modal
    {
        return Inertia::modal('Dashboard/HallTypes/Edit', [
            'hall_type'      => $hall_type,
        ])->baseRoute('dashboard.hall_types.index');
    }

    /**
     * Update the specified halltype in storage.
     *
     * @param  \Illuminate\Http\UpdateRequest  $request
     * @param  \App\Models\HallType  $halltype
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, HallType $hall_type): \Illuminate\Http\RedirectResponse
    {
        DB::beginTransaction();

        try {

            $data = $request->validated();

            $hall_type->update([
                'name'          => $data['name'],
                'description'   => $data['description'],
            ]);

            DB::commit();

            return redirect()->route('dashboard.hall_types.index')->with('success', __('HallType updated.'));
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.hall_types.index')->with('error', __('HallType not updated.'));
        }
    }

    /**
     * Show the form for deleting the specified halltype.
     *
     * @param  \App\Models\HallType  $halltype
     *
     * @return Modal
     */
    public function delete(HallType $hall_type): Modal
    {
        return Inertia::modal('Dashboard/HallTypes/Delete', [
            'hall_type'      => $hall_type,
        ])->baseRoute('dashboard.hall_types.index');
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

            return redirect()->route('dashboard.hall_types.index')->with('success', __('HallType deleted.'));
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.hall_types.index')->with('error', __('HallType not deleted.'));
        }
    }

    /**
     * Show Import hallType form.
     * @return \Inertia\Response
     */
    public function showImport(){
        return Inertia::render('Dashboard/HallTypes/Import')
            ->baseRoute('dashboard.hall_types.index');
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

            return redirect()->route('dashboard.hall_types.index')->with('success', __('HallType imported.'));
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
