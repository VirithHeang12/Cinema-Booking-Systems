<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\HallSeatTypes\StoreRequest;
use App\Http\Requests\HallSeatTypes\UpdateRequest;
use App\Http\Resources\SeatTypeResource;
use App\Models\Hall;
use App\Models\HallSeatType;
use App\Models\Seat;
use App\Models\SeatType;
use Inertia\Inertia;
use InertiaUI\Modal\Modal;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class HallSeatTypeController extends Controller
{
    private const ROWS = [
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
    ];

    /**
     * Display form for creating a new hall seat type.
     *
     * @param \App\Models\Hall $hall
     *
     * @return Modal
     */
    public function create(Hall $hall): Modal
    {
        Gate::authorize('create', HallSeatType::class);

        $seatTypes      = SeatType::whereDoesntHave('hallSeatTypes', function ($query) use ($hall) {
                $query->where('hall_id', $hall->id);
            })
            ->get();

        $seatTypes      = SeatTypeResource::collection($seatTypes)->toArray(request());
        $takenRows      = $hall->seats()->pluck('row')->unique();
        $availableRows  = collect(self::ROWS)->diff($takenRows);

        $availableRows = $availableRows->map(function ($row) {
            return [
                'id'        => $row,
                'name'      => $row,
            ];
        })->values()->toArray();

        return Inertia::modal('Dashboard/Halls/SeatTypes/Create', [
            'seat_types'                => $seatTypes,
            'hall'                      => $hall,
            'available_rows'            => $availableRows,
        ])->baseRoute('dashboard.halls.show', [
            'hall'          => $hall,
        ]);
    }

    /**
     * Store a newly created show in storage.
     *
     * @param \App\Http\Requests\HallSeatTypes\StoreRequest $request
     * @param \App\Models\Hall $hall
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request, Hall $hall): \Illuminate\Http\RedirectResponse
    {
        Gate::authorize('create', HallSeatType::class);

        DB::beginTransaction();

        try {
            $data = $request->validated();

            HallSeatType::create([
                'hall_id'           => $hall->id,
                'seat_type_id'      => $data['seat_type_id'],
            ]);

            foreach ($data['rows'] as $row) {
                for ($seatNum = 1; $seatNum <= $hall->maximum_seats_per_row; $seatNum++) {
                    Seat::create([
                        'hall_id'           => $hall->id,
                        'seat_type_id'      => $data['seat_type_id'],
                        'row'               => $row['id'],
                        'number'            => $seatNum,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('dashboard.halls.show', [
                'hall'          => $hall
            ])->with('success', __('Seat type created successfully.'));
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.halls.show', [
                'hall'          => $hall
            ])->with('error', __('Failed to create seat type. Please try again.'));
        }
    }

    /**
     * Display form for editing the specified seat type.
     *
     * @param \App\Models\Hall $hall
     * @param \App\Models\HallSeatType $seatType
     *
     * @return Modal
     */
    public function edit(Hall $hall, HallSeatType $seatType): Modal
    {
        Gate::authorize('update', $seatType);

        $seatType['rows'] = Seat::where('hall_id', $hall->id)
            ->where('seat_type_id', $seatType->seat_type_id)
            ->pluck('row')
            ->unique()
            ->map(function ($row) {
                return [
                    'id'        => $row,
                    'name'      => $row,
                ];
            })->values()->toArray();

        $seatTypes      = SeatType::all();

        $seatTypes      = SeatTypeResource::collection($seatTypes)->toArray(request());
        $takenRows      = $hall->seats()->pluck('row')->unique();

        $availableRows  = collect(self::ROWS)->diff($takenRows);

        $availableRows = $availableRows->map(function ($row) {
            return [
                'id'        => $row,
                'name'      => $row,
            ];
        })->values()->toArray();

        return Inertia::modal('Dashboard/Halls/SeatTypes/Edit', [
            'seat_types'                => $seatTypes,
            'hall'                      => $hall,
            'available_rows'            => $availableRows,
            'seat_type'                  => $seatType,
        ])->baseRoute('dashboard.halls.show', [
            'hall'          => $hall,
        ]);
    }

    /**
     * Update the specified seat type in storage.
     *
     * @param \App\Http\Requests\HallSeatTypes\UpdateRequest $request
     * @param \App\Models\Hall $hall
     * @param \App\Models\HallSeatType $seatType
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, Hall $hall, HallSeatType $seatType): \Illuminate\Http\RedirectResponse
    {
        Gate::authorize('update', $seatType);

        DB::beginTransaction();

        try {
            $data = $request->validated();

            $seatType->update([
                'seat_type_id'      => $data['seat_type_id'],
            ]);

            // Delete existing seats
            Seat::where('hall_id', $hall->id)
                ->where('seat_type_id', $seatType->seat_type_id)
                ->delete();

            // Create new seats
            foreach ($data['rows'] as $row) {
                for ($seatNum = 1; $seatNum <= $hall->maximum_seats_per_row; $seatNum++) {
                    Seat::create([
                        'hall_id'           => $hall->id,
                        'seat_type_id'      => $seatType->seat_type_id,
                        'row'               => $row['id'],
                        'number'            => $seatNum,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('dashboard.halls.show', [
                'hall'          => $hall
            ])->with('success', __('Seat type updated successfully.'));
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.halls.show', [
                'hall'          => $hall
            ])->with('error', __('Failed to update seat type. Please try again.'));
        }
    }

    /**
     * Show the form for deleting the specified seat type.
     *
     * @param \App\Models\Hall $hall
     * @param \App\Models\HallSeatType $seatType
     *
     * @return Modal
     */
    public function delete(Hall $hall, HallSeatType $seatType): Modal
    {
        Gate::authorize('delete', $seatType);

        return Inertia::modal('Dashboard/Halls/SeatTypes/Delete', [
            'hall'          => $hall,
            'seat_type'     => $seatType,
        ])->baseRoute('dashboard.halls.show', [
            'hall'          => $hall,
        ]);
    }

    /**
     * Remove the specified seat type from storage.
     *
     * @param \App\Models\Hall $hall
     * @param \App\Models\HallSeatType $seatType
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Hall $hall, HallSeatType $seatType): \Illuminate\Http\RedirectResponse
    {
        Gate::authorize('delete', $seatType);

        DB::beginTransaction();

        try {
            $seatType->delete();

            Seat::where('hall_id', $hall->id)
                ->where('seat_type_id', $seatType->seat_type_id)
                ->delete();

            DB::commit();

            return redirect()->route('dashboard.halls.show', [
                'hall'          => $hall
            ])->with('success', __('Seat type deleted successfully.'));
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.halls.show', [
                'hall'          => $hall
            ])->with('error', __('Failed to delete seat type. Please try again.'));
        }
    }
}
