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
        return Inertia::render('Dashboard/Classifications/Index', [
            'classifications' => Classification::all()
        ]);
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
     * @return \Inertia\Response
     */
    public function edit(Classification $classification): \Inertia\Response
    {
        return Inertia::render('Dashboard/Classifications/Edit', ['classification' => $classification]);
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
}
