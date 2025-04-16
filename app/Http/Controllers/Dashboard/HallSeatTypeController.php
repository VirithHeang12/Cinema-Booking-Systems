<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\ShowStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\HallSeatTypes\StoreRequest;
use App\Http\Resources\Api\LanguageResource;
use App\Http\Resources\Api\ScreenTypeResource;
use App\Http\Resources\HallResource;
use App\Http\Resources\SeatTypeResource;
use App\Models\Hall;
use App\Models\HallSeatType;
use App\Models\Movie;
use App\Models\MovieSubtitle;
use App\Models\ScreenType;
use App\Models\Seat;
use App\Models\SeatType;
use App\Models\Show;
use Carbon\Carbon;
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

        $seatTypes      = SeatType::whereDoesntHave('hallSeatTypes')
            ->whereDoesntHave('seats', function ($query) use ($hall) {
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
                'maximum_capacity'  => $data['maximum_capacity'],
            ]);

            foreach ($data['rows'] as $row) {
                for ($seatNum = 1; $seatNum <= $data['maximum_capacity']; $seatNum++) {
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
     * Display form for editing the specified show.
     *
     * @param \App\Models\Movie $movie
     * @param \App\Models\Show $show
     *
     * @return Modal
     */
    public function edit(Movie $movie, Show $show): Modal
    {
        Gate::authorize('update', $show);

        $halls          = HallResource::collection(Hall::all())->toArray(request());
        $screenTypes    = ScreenTypeResource::collection(ScreenType::all())->toArray(request());
        $languages      = collect(MovieSubtitle::where('movie_id', $movie->id)->with('language')->get())->map(
            function ($subtitle) {
                return LanguageResource::make($subtitle->language)->toArray(request());
            }
        );

        $show['language_id'] = $show->movieSubtitle->language?->id;
        $show['show_time']   = Carbon::parse($show->show_time)->format('Y-m-d\TH:i:s');

        return Inertia::modal('Dashboard/Movies/Shows/Edit', [
            'halls'         => $halls,
            'screen_types'  => $screenTypes,
            'languages'     => $languages,
            'movie'         => $movie,
            'show'          => $show,
        ])->baseRoute('dashboard.movies.show', [
            'movie'         => $movie,
        ]);
    }

    /**
     * Update the specified show in storage.
     *
     * @param \App\Http\Requests\Shows\UpdateRequest $request
     * @param \App\Models\Movie $movie
     * @param \App\Models\Show $show
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, Movie $movie, Show $show): \Illuminate\Http\RedirectResponse
    {
        Gate::authorize('update', $show);

        DB::beginTransaction();

        try {
            $data = $request->validated();

            $movieSubtitle = MovieSubtitle::where('movie_id', $movie->id)
                ->where('language_id', $data['language_id'])
                ->first();

            $show->update([
                'movie_subtitle_id' => $movieSubtitle?->id,
                'hall_id'           => $data['hall_id'],
                'screen_type_id'    => $data['screen_type_id'],
                'show_time'         => $data['show_time'],
                'status'            => $data['status'] ?? ShowStatus::SCHEDULED,
            ]);

            DB::commit();

            return redirect()->route('dashboard.movies.show', [
                'movie'         => $movie
            ])->with('success', __('Show updated successfully.'));
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.movies.show', [
                'movie'         => $movie
            ])->with('error', __('Failed to update show. Please try again.'));
        }
    }

    /**
     * Show the form for deleting the specified show.
     *
     * @param \App\Models\Movie $movie
     * @param \App\Models\Show $show
     *
     * @return Modal
     */
    public function delete(Movie $movie, Show $show): Modal
    {
        Gate::authorize('delete', $show);

        return Inertia::modal('Dashboard/Movies/Shows/Delete', [
            'movie' => $movie,
            'show'  => $show,
        ])->baseRoute('dashboard.movies.show', [
            'movie' => $movie,
        ]);
    }

    /**
     * Remove the specified show from storage.
     *
     * @param \App\Models\Movie $movie
     * @param \App\Models\Show $show
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Movie $movie, Show $show): \Illuminate\Http\RedirectResponse
    {
        Gate::authorize('delete', $show);

        DB::beginTransaction();

        try {
            $show->delete();

            DB::commit();

            return redirect()->route('dashboard.movies.show', [
                'movie' => $movie
            ])->with('success', __('Show deleted successfully.'));
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.movies.show', [
                'movie' => $movie
            ])->with('error', __('Failed to delete show. Please try again.'));
        }
    }
}
