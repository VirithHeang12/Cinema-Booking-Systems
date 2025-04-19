<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Seat;
use App\Models\SeatType;
use App\Models\Show;
use App\Models\Booking;
use App\Models\ShowSeat;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Enums\ShowSeatStatus;


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

        $seatTypes = SeatType::whereHas('seats', function ($query) use ($show) {
            $query->where('hall_id', $show->hall_id);
        })->select('name', 'price')->distinct()->get();

        $paymentMethods = PaymentMethod::where('is_active', true)->get(['id', 'name']);

        return Inertia::render('BookingTicket', [
            'movie'     => $movie,
            'show'      => $show,
            'seatRows'  => $seatRows,
            'seatTypes' => $seatTypes,
            'paymentMethods' => $paymentMethods,
        ]);
    }

    /**
     * Store a new booking.
     *
     */

    public function store(Request $request)
    {
        $data = $request->validate([
            'show_id' => 'required|exists:shows,id',
            'selected_seat_ids' => 'required|array',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'guest_email' => 'nullable|email',
            'total_amount' => 'required|numeric',
        ]);

        DB::transaction(function () use ($data) {
            $booking = Booking::create([
                'user_id'           => Auth::check() ? Auth::id() : null,
                'guest_email'       => $data['guest_email'],
                'payment_method_id' => $data['payment_method_id'],
                'qr_code'           => null,
                'total_amount'      => $data['total_amount'],
                'booking_date'      => now(),
                'status'            => 'Confirmed',
            ]);

            foreach ($data['selected_seat_ids'] as $seatId) {
                ShowSeat::firstOrCreate(
                    [
                        'show_id' => $data['show_id'],
                        'seat_id' => $seatId
                    ],
                    [
                        'status' => ShowSeatStatus::BOOKED->value,
                        'booking_id' => $booking->id
                    ]
                );
            }


        });

        return back()->with('success', 'Dummy booking completed successfully!');
    }
}
