<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\HallType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class HallTypeController extends Controller
{
    /**
     * Display a listing of HallTypes.
     *
     * @return \Inertia\Response
     */
    public function index(): \Inertia\Response
    {
        $halltypes = HallType::all();

        return Inertia::render('Dashboard/HallTypes/Index', [
            'halltypes'     => $halltypes,
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

            return redirect()->route('dashboard.halltypes.index')->with('success', 'HallType created.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.halltypes.index')->with('error', 'HallType not created.');
        }
    }

    /**
     * Display the specified halltype.
     *
     * @param  \App\Models\HallType  $halltype
     *
     * @return \Inertia\Response
     */
    public function show(HallType $halltype): \Inertia\Response
    {
        return Inertia::render('Dashboard/HallTypes/Show', [
            'halltype'      => $halltype,
        ]);
    }

    /**
     * Show the form for editing the specified halltype.
     *
     * @param  \App\Models\HallType  $halltype
     *
     * @return \Inertia\Response
     */
    public function edit(HallType $halltype): \Inertia\Response
    {
        return Inertia::render('Dashboard/HallTypes/Edit', [
            'halltype'      => $halltype,
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
    public function update(Request $request, HallType $halltype): \Illuminate\Http\RedirectResponse
    {
        DB::beginTransaction();

        try {

            $halltype->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            DB::commit();

            return redirect()->route('dashboard.halltypes.index')->with('success', 'HallType updated.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.halltypes.index')->with('error', 'HallType not updated.');
        }
    }

    /**
     * Show the form for deleting the specified halltype.
     *
     * @param  \App\Models\HallType  $halltype
     *
     * @return \Inertia\Response
     */
    public function delete(HallType $halltype): \Inertia\Response
    {
        return Inertia::render('Dashboard/HallTypes/Delete', [
            'halltype'      => $halltype,
        ]);
    }

    /**
     * Remove the specified halltype from storage.
     *
     * @param  \App\Models\HallType  $halltype
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(HallType $halltype): \Illuminate\Http\RedirectResponse
    {
        DB::beginTransaction();

        try {

            $halltype->delete();

            DB::commit();

            return redirect()->route('dashboard.halltypes.index')->with('success', 'HallType deleted.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.halltypes.index')->with('error', 'HallType not deleted.');
        }
    }
}
