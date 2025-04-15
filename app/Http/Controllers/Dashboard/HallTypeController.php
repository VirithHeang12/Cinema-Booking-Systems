<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\HallType;
use App\Http\Requests\HallTypes\ImportHallTypesRequest;
use App\Http\Resources\Api\HallTypeResource;
use App\Http\Requests\HallTypes\StoreRequest;
use App\Http\Requests\HallTypes\UpdateRequest;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\HallTypesImport;
use App\Exports\HallTypesExport;
use InertiaUI\Modal\Modal;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\Gate;
use Spatie\QueryBuilder\AllowedFilter;

class HallTypeController extends Controller
{
    /**
     * Display a listing of HallTypes.
     *
     * @return \Inertia\Response
     */
    public function index(): \Inertia\Response
    {
        Gate::authorize('viewAny', HallType::class);

        $perPage = request()->query('itemsPerPage', 10);

        $hall_types = QueryBuilder::for(HallType::class)
            ->allowedFilters([
                AllowedFilter::callback('search', function ($query, $value) {
                    $query->where('name', 'like', "%{$value}%");
                }),
            ])
            ->allowedSorts(
                'name',
            )
            ->paginate($perPage)
            ->appends(request()->query());

        $hall_types = HallTypeResource::collection($hall_types)->response()->getData(true);

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
        Gate::authorize('create', HallType::class);

        return Inertia::modal('Dashboard/HallTypes/Create')
            ->baseRoute('dashboard.hall_types.index');
    }

    /**
     * Store a newly created HallType in storage.
     *
     * @param  \Illuminate\Http\StoreRequest  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request): \Illuminate\Http\RedirectResponse
    {
        Gate::authorize('create', HallType::class);

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
        Gate::authorize('view', $hall_type);

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
        Gate::authorize('update', $hall_type);

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
        Gate::authorize('update', $hall_type);

        $data = $request->validated();

        DB::beginTransaction();

        try {

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
        Gate::authorize('delete', $hall_type);

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
        Gate::authorize('delete', $hall_type);

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
     * Show import halltype form.
     *
     * @return Modal
     */
    public function showImport(): Modal
    {
        Gate::authorize('import', HallType::class);

        return Inertia::modal('Dashboard/HallTypes/Import')->baseRoute('dashboard.hall_types.index');
    }

    /**
     * Import halltype from excel file.
     *
     * @param  ImportHallTypesRequest  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(ImportHallTypesRequest $request): \Illuminate\Http\RedirectResponse
    {
        Gate::authorize('import', HallType::class);

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
        Gate::authorize('export', HallType::class);

        return Excel::download(new HallTypesExport, 'hall_types.xlsx');
    }
}
