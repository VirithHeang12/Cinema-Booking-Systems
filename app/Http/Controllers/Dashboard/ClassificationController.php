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
use App\Http\Resources\Api\ClassificationResource;
use InertiaUI\Modal\Modal;
use Illuminate\Support\Facades\Gate;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;




class ClassificationController extends Controller
{
    /**
     * Display a listing of the classifications.
     *
     * @return \Inertia\Response
     */
    public function index(): \Inertia\Response
    {
        Gate::authorize('viewAny', Classification::class);

        $perPage = request()->query('itemsPerPage', 10);

        $classifications = QueryBuilder::for(Classification::class)
        ->allowedFilters([
            AllowedFilter::callback('search', function ($query, $value) {
                $query->where('name', 'like', "%{$value}%")
                    ->orWhere('description', 'like', "%{$value}%");
            }),
        ])
        ->allowedSorts('name', 'description')
        ->paginate($perPage)
        ->appends(request()->query());

        $classifications = ClassificationResource::collection($classifications)->response()->getData(true);

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
        Gate::authorize('create', Classification::class);

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
        Gate::authorize('create', Classification::class);

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
     * @return Modal
     */
    public function show(Classification $classification): Modal
    {
        Gate::authorize('view', $classification);

        return Inertia::modal('Dashboard/Classifications/Show',[
            'classification' => $classification
        ])->baseRoute('dashboard.classifications.index');
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
        Gate::authorize('update', $classification);

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
        Gate::authorize('update', $classification);

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
     * @return Modal
     */
    public function delete(Classification $classification): Modal
    {
        Gate::authorize('delete', $classification);

        return Inertia::modal('Dashboard/Classifications/Delete', [
            'classification' => $classification
        ])->baseRoute('dashboard.classifications.index');
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
        Gate::authorize('delete', $classification);

        DB::beginTransaction();

        try {
            $classification->delete();

            DB::commit();

            return redirect()->route('dashboard.classifications.index')->with('success', __('Classification deleted.'));
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.classifications.index')->with('error', __('Classification not deleted.'));
        }
    }

    /**
     * Show Import classifications form.
     * @return Modal
     */
    public function showImport(): Modal
    {
        Gate::authorize('import', Classification::class);

        return Inertia::modal('Dashboard/Classifications/Import')->baseRoute('dashboard.classifications.index');
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
        Gate::authorize('import', Classification::class);

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
        Gate::authorize('export', Classification::class);

        return Excel::download(new ClassificationsExport, 'classifications.xlsx');
    }
}
