<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Halls\StoreRequest;
use App\Http\Requests\Halls\UpdateRequest;
use App\Http\Resources\Api\HallTypeResource;
use App\Http\Resources\HallResource;
use App\Http\Resources\HallSeatTypeResource;
use App\Models\Hall;
use App\Models\HallSeatType;
use App\Models\HallType;
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

        return Inertia::modal('Dashboard/Halls/Create', [
            'hall_types'    => $hallTypes,
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
            Hall::create([
                'name'              => $data['name'],
                'description'       => $data['description'],
                'hall_type_id'      => $data['hall_type_id'],
            ]);

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

        $hall->load(['hallType', 'seats', 'hallSeatTypes']);

        $seatTypes = QueryBuilder::for(HallSeatType::class)
            ->where('hall_id', $hall->id)
            ->with(['hall', 'seatType', 'hall.seats'])
            ->paginate(5)
            ->appends(request()->query());

        $seatTypes = HallSeatTypeResource::collection($seatTypes)->response()->getData(true);

        return Inertia::render('Dashboard/Halls/Show', [
            'hall'          => new HallResource($hall),
            'seat_types'    => $seatTypes,
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

        return Inertia::modal('Dashboard/Halls/Edit', [
            'hall'                      => $hall,
            'hall_types'                => $hallTypes,
        ])->baseRoute('dashboard.halls.index');
    }

    /**
     * Update the specified hall in storage.
     *
     * @param  UpdateRequest  $request
     * @param  \App\Models\Hall  $hall
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, Hall $hall): \Illuminate\Http\RedirectResponse
    {
        Gate::authorize('update', $hall);

        $data = $request->validated();

        DB::beginTransaction();

        try {
            $hall->update([
                'name'              => $data['name'],
                'description'       => $data['description'],
                'hall_type_id'      => $data['hall_type_id'],
            ]);

            DB::commit();

            return redirect()->route('dashboard.halls.index')->with('success', 'Hall updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.halls.index')->with('error', 'Hall update failed.');
        }
    }

    /**
     * Show the form for deleting the specified hall.
     *
     * @param  \App\Models\Hall  $hall
     *
     * @return Modal
     */
    public function delete(Hall $hall): Modal
    {
        Gate::authorize('delete', $hall);

        return Inertia::modal('Dashboard/Halls/Delete', [
            'hall'      => $hall,
        ])->baseRoute('dashboard.halls.index');
    }

    /**
     * Remove the specified hall from storage.
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
            $hall->delete();

            DB::commit();

            return redirect()->route('dashboard.halls.index')->with('success', 'Hall deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.halls.index')->with('error', 'Hall deletion failed.');
        }
    }
}
