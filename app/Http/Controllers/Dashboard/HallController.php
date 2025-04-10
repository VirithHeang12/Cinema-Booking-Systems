<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Halls\StoreRequest;
use App\Http\Resources\Api\HallTypeResource;
use App\Http\Resources\HallResource;
use App\Http\Resources\SeatTypeResource;
use App\Models\Hall;
use App\Models\HallType;
use App\Models\HallSeatType;
use App\Models\Seat;
use App\Models\SeatType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;
use InertiaUI\Modal\Modal;

class HallController extends Controller
{
    /**
     * Display a listing of halls.
     *
     * @return \Inertia\Response
     */
    public function index(): \Inertia\Response
    {
        Gate::authorize('viewAny', Hall::class);

        $perPage = request()->query('itemsPerPage', 10);

        $halls = QueryBuilder::for(Hall::class)
            ->allowedFilters([
                AllowedFilter::callback('search', function ($query, $value) {
                    $query->where('name', 'like', "%{$value}%")
                        ->orWhere('description', 'like', "%{$value}%");
                }),
                AllowedFilter::callback('hall_type', function ($query, $value) {
                    $query->whereHas('hallType', function ($q) use ($value) {
                        $q->where('name', $value);
                    });
                }),
            ])
            ->allowedSorts(
                AllowedSort::callback('seats_count', function ($query, $descending) {
                    $direction = $descending ? 'desc' : 'asc';
                    $query->withCount('seats')->orderBy('seats_count', $direction);
                }),
                AllowedSort::field('name'),
            )
            ->with(['hallType', 'seats', 'hallSeatTypes'])
            ->withCount('seats')
            ->paginate($perPage)
            ->appends(request()->query());

        $halls = HallResource::collection($halls)->response()->getData(true);

        return Inertia::render('Dashboard/Halls/Index', [
            'halls' => $halls,
        ]);
    }

    /**
     * Show the form for creating a new hall.
     *
     * @return Modal
     */
    public function create(): Modal
    {
        Gate::authorize('create', Hall::class);

        $hallTypes = HallTypeResource::collection(HallType::all())->toArray(request());
        $seatTypes = SeatTypeResource::collection(SeatType::all())->toArray(request());

        return Inertia::modal('Dashboard/Halls/Create', [
            'hall_types' => $hallTypes,
            'seat_types' => $seatTypes,
        ])->baseRoute('dashboard.halls.index');
    }

    /**
     * Store a newly created Hall in storage.
     *
     * @param  StoreRequest  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request): \Illuminate\Http\RedirectResponse
    {
        Gate::authorize('create', Hall::class);

        $data = $request->validated();

        DB::beginTransaction();

        try {
            $hall = Hall::create([
                'name'              => $request->name,
                'description'       => $request->description,
                'hall_type_id'      => $request->hall_type_id,
            ]);

            foreach ($request->hallSeatTypes as $hallSeatTypeData) {
                $maxCapacity = (int) $hallSeatTypeData['maximum_capacity'];

                HallSeatType::create([
                    'hall_id'               => $hall->id,
                    'seat_type_id'          => $hallSeatTypeData['seat_type_id'],
                    'maximum_capacity'      => $maxCapacity,
                ]);

                $rows = $hallSeatTypeData['rows'];

                foreach ($rows as $row) {
                    for ($seatNum = 1; $seatNum <= $maxCapacity; $seatNum++) {
                        Seat::create([
                            'hall_id'           => $hall->id,
                            'seat_type_id'      => $hallSeatTypeData['seat_type_id'],
                            'row'               => $row,
                            'number'            => $seatNum,
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()->route('dashboard.halls.index')->with('success', 'Hall created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('dashboard.halls.index')->with('error', 'Hall creation failed: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified Hall.
     *
     * @param  \App\Models\Hall  $hall
     *
     * @return \Inertia\Response
     */
    public function show(Hall $hall): \Inertia\Response
    {
        Gate::authorize('view', $hall);

        $hall->load(['hallType', 'seats', 'hallSeatTypes.seatType']);

        return Inertia::render('Dashboard/Halls/Show', [
            'hall' => new HallResource($hall),
        ]);
    }

    /**
     * Show the form for editing the specified Hall.
     *
     * @param  \App\Models\Hall  $hall
     *
     * @return Modal
     */
    public function edit(Hall $hall): Modal
    {
        Gate::authorize('update', $hall);

        $hallTypes = HallTypeResource::collection(HallType::all())->toArray(request());
        $seatTypes = SeatTypeResource::collection(SeatType::all())->toArray(request());

        $hall->load(['hallType', 'hallSeatTypes', 'hallSeatTypes.seatType', 'hallSeatTypes.seatType.seats']);

        $hall->hallSeatTypes = $hall->hallSeatTypes->map(function ($hallSeatType) {
            return [
                'id'                    => $hallSeatType->id,
                'seat_type_id'          => $hallSeatType->seat_type_id,
                'maximum_capacity'      => $hallSeatType->maximum_capacity,
                'rows'                  => $hallSeatType->seatType->seats->groupBy('row')->keys()->all()
            ];
        });

        return Inertia::modal('Dashboard/Halls/Edit', [
            'hall'                      => $hall,
            'hall_types'                => $hallTypes,
            'seat_types'                => $seatTypes,
        ])->baseRoute('dashboard.halls.index');
    }

    /**
     * Update the specified Hall in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hall  $hall
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Hall $hall): \Illuminate\Http\RedirectResponse
    {
        Gate::authorize('update', $hall);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'hall_type_id' => 'required|exists:hall_types,id',
        ]);

        DB::beginTransaction();

        try {
            $hall->update([
                'name' => $request->name,
                'description' => $request->description,
                'hall_type_id' => $request->hall_type_id,
            ]);

            DB::commit();

            return redirect()->route('dashboard.halls.index')->with('success', 'Hall updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.halls.index')->with('error', 'Hall update failed.');
        }
    }

    /**
     * Show the form for deleting the specified Hall.
     *
     * @param  \App\Models\Hall  $hall
     *
     * @return \Inertia\Response
     */
    public function delete(Hall $hall): \Inertia\Response
    {
        Gate::authorize('delete', $hall);

        return Inertia::render('Dashboard/Halls/Delete', [
            'hall' => new HallResource($hall),
        ]);
    }

    /**
     * Remove the specified Hall from storage.
     *
     * @param  \App\Models\Hall  $hall
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Hall $hall): \Illuminate\Http\RedirectResponse
    {
        Gate::authorize('delete', $hall);

        DB::beginTransaction();

        try {
            // This will cascade delete related records due to foreign key constraints
            $hall->delete();

            DB::commit();

            return redirect()->route('dashboard.halls.index')->with('success', 'Hall deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.halls.index')->with('error', 'Hall deletion failed.');
        }
    }
}
