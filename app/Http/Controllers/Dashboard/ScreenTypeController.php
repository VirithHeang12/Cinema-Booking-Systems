<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ScreenType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ScreenTypeController extends Controller
{
    //
    public function index()
    {

        $scereenTypes = ScreenType::all();

        return Inertia::render('Dashboard/ScreenTypes/Index', [
            'screenTypes' => $scereenTypes,
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

            return redirect()->route('dashboard.screen-types.index')->with('success', 'Screen Type created.');
        }catch(\Exception $e){
            DB::rollBack();

            return redirect()->route('dashboard.screen-types.index')->with('error', 'Screen Type not created.');
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

            return redirect()->route('dashboard.screen-types.index')->with('success', 'Screen Type updated.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.screen-types.index')->with('error', 'Screen Type not updated.');
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

            return redirect()->route('dashboard.screen-types.index')->with('success', 'Screen Type deleted.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.screen-type.index')->with('error', 'Screen Type not deleted.');
        }
    }

}
