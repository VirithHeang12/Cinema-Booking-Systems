<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Seat;
use App\Models\SeatType;
use App\Models\Show;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class BookingController extends Controller
{
    /**
     * Display the booking page.
     *
     * @param  \App\Models\Show  $show
     *
     * @return \Inertia\Response
     */
    public function show(Show $show): \Inertia\Response
    {
        $show->load('hall');

        $movie = Movie::with(['movieGenres.genre', 'movieSubtitles.language'])
            ->where('id', $show->movieSubtitle->movie_id)
            ->first();

        $seatRows = Seat::with('seatType')->where('hall_id', $show->hall_id)->get();


        $seatRows = collect($seatRows)->groupBy('row')->map(function ($row) use ($show) {
            $seat = $row->first();

            return [
                'label' => $seat->row,
                'seatType'  =>  [
                    'name'  => $seat->seatType->name,
                    'price' => $seat->seatType->price
                ],
                'seats' => $row->map(function ($seat) use ($show) {

                    return [
                        'id'            => $seat->id,
                        'number'        => $seat->number,
                        'status'        => !$seat->showSeats()->where('show_id', $show->id)->exists() ?
                            'available' : 'unavailable',
                    ];
                }),
            ];
        })->sortByDesc('label')->values()->toArray();

        $seatTypes = SeatType::select('name', 'price')->get();

        return Inertia::render('BookingTicket', [
            'movie'     => $movie,
            'show'      => $show,
            'seatRows'  => $seatRows,
            'seatTypes' => $seatTypes,
        ]);
    }

    /**
     * Store a new booking.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    // public function store(\Illuminate\Http\Request $request): \Illuminate\Http\RedirectResponse
    // {
    // }

}
