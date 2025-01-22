<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Classification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;


class ClassificationController extends Controller
{
    /**
     * Display a listing of the classifications.
     *
     * @return \Inertia\Response
     */
    public function index(): \Inertia\Response
    {
        return Inertia::render('Dashboard/Classifications/Index');
    }

    /**
     * Show the form for creating a new classification.
     *
     * @return \Inertia\Response
     *
     */
    public function create(): \Inertia\Response
    {
        return Inertia::render('Dashboard/Classifications/Create');
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
}
