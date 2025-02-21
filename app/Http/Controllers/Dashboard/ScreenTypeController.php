<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\ScreenTypesExport;
use App\Http\Controllers\Controller;
use App\Imports\ScreenTypeImport;
use App\Models\ScreenType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class ScreenTypeController extends Controller
{
    //
    public function index()
    {

         // $screenTypes = ScreenType::all();
        $perPage = request()->query('itemsPerPage', 5);
        $screenTypes = ScreenType::paginate($perPage)->appends(request()->query());

        return Inertia::render('Dashboard/ScreenTypes/Index', [
            'screenTypes'     => $screenTypes,
        ]);
    }

    public function create()
    {
        return Inertia::render('Dashboard/ScreenTypes/Create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try{
            ScreenType::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            DB::commit();

            return redirect()->route('dashboard.screen_types.index')->with('success', 'Screen Type created.');
        }catch(\Exception $e){
            DB::rollBack();

            return redirect()->route('dashboard.screen_types.index')->with('error', 'Screen Type not created.');
        }
    }

    public function show(ScreenType $screen_type)
    {
        return Inertia::render('Dashboard/ScreenTypes/Show', [
            'screen_type' => $screen_type,
        ]);
    }

    public function edit(ScreenType $screen_type){
        return Inertia::render('Dashboard/ScreenTypes/Edit', [
            'screen_type'      => $screen_type,
        ]);
    }

    public function update(Request $request, ScreenType $screen_type): \Illuminate\Http\RedirectResponse
    {
        DB::beginTransaction();

        try {

            $screen_type->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            DB::commit();

            return redirect()->route('dashboard.screen_types.index')->with('success', 'Screen Type updated.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.screen_types.index')->with('error', 'Screen Type not updated.');
        }
    }

    public function delete(ScreenType $screen_type): \inertia\response{

        return Inertia::render('Dashboard/ScreenTypes/Delete', [
            'screen_type'      => $screen_type,
        ]);
    }

    public function destroy(ScreenType $screen_type): \Illuminate\Http\RedirectResponse
    {
        DB::beginTransaction();

        try {

            $screen_type->delete();

            DB::commit();

            return redirect()->route('dashboard.screen_types.index')->with('success', 'Screen Type deleted.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.screen_type.index')->with('error', 'Screen Type not deleted.');
        }
    }

      /**
     * Show Import ScreenTypes form.
     * @return \Inertia\Response
     */
    public function showImport(){
        return Inertia::render('Dashboard/ScreenTypes/Import');
    }

     /**
     * Import ScreenType from excel file.
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
            Excel::import(new ScreenTypeImport, $request->file('file'));
            DB::commit();

            return redirect()->route('dashboard.screen_types.index')->with('success', 'Genres imported.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('dashboard.screen_types.index')->with('error', $e->getMessage());
        }
    }

    public function export()
    {
        return Excel::download(new ScreenTypesExport, 'screen_type.xlsx');
    }

}
