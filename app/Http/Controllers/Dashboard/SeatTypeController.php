<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SeatTypesExport;
use App\Http\Requests\SeatTypes\ImportRequest;
use App\Http\Requests\SeatTypes\StoreRequest;
use App\Http\Requests\SeatTypes\UpdateRequest;
use InertiaUI\Modal\Modal;
use Illuminate\Support\Facades\Gate;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Resources\SeatTypeResource;
use App\Imports\SeatTypesImport;
use App\Models\SeatType;
use Spatie\QueryBuilder\AllowedSort;

class SeatTypeController extends Controller
{
    /**
     * Display a listing of seat types.
     *
     * @return \Inertia\Response
     */
    public function index(): \Inertia\Response
    {
        Gate::authorize('viewAny', SeatType::class);

        $perPage = request()->query('itemsPerPage', 5);

        $seatTypes = QueryBuilder::for(SeatType::class)
            ->allowedFilters([
                AllowedFilter::callback('search', function ($query, $value) {
                    $query->where('name', 'like', "%{$value}%")
                        ->orWhere('description', 'like', "%{$value}%");
                }),
            ])
            ->allowedSorts([
                'name',
                'price',
                AllowedSort::callback('seats_count', function ($query, $descending) {
                    $direction = $descending ? 'desc' : 'asc';
                    $query->withCount('seats')->orderBy('seats_count', $direction);
                }),
            ])
            ->with(['seats', 'hallSeatTypes'])
            ->withCount('seats')
            ->paginate($perPage)
            ->appends(request()->query());

        $seatTypes = SeatTypeResource::collection($seatTypes)->response()->getData(true);

        return Inertia::render('Dashboard/SeatTypes/Index', [
            'seat_types'     => $seatTypes,
        ]);
    }


    /**
     * Show the form for creating a new seat type.
     *
     * @return Modal
     */
    public function create(): Modal
    {
        Gate::authorize('create', SeatType::class);

        return Inertia::modal('Dashboard/SeatTypes/Create')
            ->baseRoute('dashboard.seat_types.index');
    }


    /**
     * Store a newly created seat type in storage.
     *
     * @param  StoreRequest  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request): \Illuminate\Http\RedirectResponse
    {
        Gate::authorize('create', SeatType::class);

        DB::beginTransaction();

        try {
            $data = $request->validated();

            SeatType::create([
                'name'          => $data['name'],
                'description'   => $data['description'],
                'price'         => $data['price'],
            ]);

            DB::commit();

            return redirect()->route('dashboard.seat_types.index')->with('success', 'Seat type created.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.seat_types.index')->with('error', 'Seat type not created.');
        }
    }

    /**
     * Show the form for editing a seat type.
     *
     * @param \App\Models\SeatType  $seatType
     *
     * @return Modal
     */
    public function edit(SeatType $seatType): Modal
    {
        Gate::authorize('update', $seatType);

        return Inertia::modal('Dashboard/SeatTypes/Edit', [
            'seat_type'         => $seatType
        ])->baseRoute('dashboard.seat_types.index');
    }

    /**
     * Update the specified seat type in storage.
     *
     * @param  UpdateRequest  $request
     * @param  \App\Models\SeatType  $seatType
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, SeatType $seatType): \Illuminate\Http\RedirectResponse
    {
        Gate::authorize('update', $seatType);

        DB::beginTransaction();

        try {
            $data = $request->validated();

            $seatType->update([
                'name'          => $data['name'],
                'description'   => $data['description'],
                'price'         => $data['price'],
            ]);

            DB::commit();

            return redirect()->route('dashboard.seat_types.index')->with('success', 'Seat type updated.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.seat_types.index')->with('error', 'Seat type not updated.');
        }
    }

    /**
     * Display the specified seat type.
     *
     * @param  \App\Models\SeatType  $seatType
     *
     * @return Modal
     */
    public function show(SeatType $seatType): Modal
    {
        Gate::authorize('view', $seatType);

        return Inertia::modal('Dashboard/SeatTypes/Show', [
            'seat_type'      => $seatType,
        ])->baseRoute('dashboard.seat_types.index');
    }

    /**
     * Show the form for deleting the specified seat type.
     *
     * @param  \App\Models\SeatType  $seatType
     *
     * @return Modal
     */
    public function delete(SeatType $seatType): Modal
    {
        Gate::authorize('delete', $seatType);

        return Inertia::modal('Dashboard/SeatTypes/Delete', [
            'seat_type'      => $seatType,
        ])->baseRoute('dashboard.seat_types.index');
    }

    /**
     * Remove the specified seat type from storage.
     *
     * @param  \App\Models\SeatType  $seatType
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(SeatType $seatType): \Illuminate\Http\RedirectResponse
    {
        Gate::authorize('delete', $seatType);

        DB::beginTransaction();

        try {
            $seatType->delete();

            DB::commit();
            return redirect()->route('dashboard.seat_types.index')->with('success', 'Seat type deleted.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('dashboard.seat_types.index')->with('error', 'Seat type not deleted.');
        }
    }

    /**
     * Show form for importing seat types.
     *
     * @return Modal
     */
    public function showImport(): Modal
    {
        Gate::authorize('import', SeatType::class);

        return Inertia::modal('Dashboard/SeatTypes/Import')
            ->baseRoute('dashboard.seat_types.index');
    }

    /**
     * Import seat types from excel file.
     *
     * @param  ImportRequest  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(ImportRequest $request): \Illuminate\Http\RedirectResponse
    {
        Gate::authorize('import', SeatType::class);

        DB::beginTransaction();

        try {
            Excel::import(new SeatTypesImport, $request->file('file'));

            DB::commit();

            return redirect()->route('dashboard.seat_types.index')->with('success', 'Seat types imported.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('dashboard.seat_types.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Export seat types to excel file.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        Gate::authorize('export', SeatType::class);

        return Excel::download(new SeatTypesExport, 'seat_types.xlsx');
    }
}
