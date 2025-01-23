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
}
