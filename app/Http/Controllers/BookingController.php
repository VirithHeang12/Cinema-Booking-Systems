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
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Spatie\QueryBuilder\QueryBuilder;

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
            'movie'             => $movie,
            'show'              => $show,
            'seatRows'          => $seatRows,
            'seatTypes'         => $seatTypes,
            'paymentMethods'    => $paymentMethods,
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

        $response = Http::get('https://api.qrserver.com/v1/create-qr-code/?data=HelloWorld!&size=100x100');

        $qrCodePath = 'qr_codes/' . Str::random(10) . '.png';

        Storage::disk('public')->put($qrCodePath , $response->body());

        $qrCodeUrl = Storage::url($qrCodePath);

        DB::transaction(function () use ($data, $qrCodeUrl) {
            $booking = Booking::create([
                'user_id'           => Auth::check() ? Auth::id() : null,
                'guest_email'       => $data['guest_email'],
                'payment_method_id' => $data['payment_method_id'],
                'qr_code'           => $qrCodeUrl,
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

        return redirect()->route('booking.tickets')->with('success', 'Booking completed successfully!');
    }

    /**
     * Show the tickets for a booking.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Inertia\Response
     */
    public function tickets(Request $request): \Inertia\Response
    {
        $bookings = QueryBuilder::for(Booking::class)
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        $bookings = $bookings->map(function ($booking) {
            $booking->load(['showSeats.seat', 'showSeats.show.hall.hallType', 'showSeats.show.movieSubtitle.movie', 'showSeat', 'showSeat.show.movieSubtitle.movie']);

            return [
                'movie'                 => [
                    'title'             => $booking->showSeat->show->movieSubtitle->movie->title,
                    'thumbnail_url'     => $booking->showSeat->show->movieSubtitle->movie->thumbnail_url,
                ],
                'hall'                  => [
                    'name'              => $booking->showSeat->show->hall->name,
                    'type'              => $booking->showSeat->show->hall->hallType->name,
                ],
                'show'                  => [
                    'date'              => $booking->showSeat->show->show_time->format('Y-m-d'),
                    'time'              => $booking->showSeat->show->show_time->format('H:i'),
                ],
                'qr_code'               => $booking->qr_code,
                'total_amount'          => $booking->total_amount,
                'seats'                 => $booking->showSeats->map(function ($showSeat) {
                    return [
                        'label'         => $showSeat->seat->row . $showSeat->seat->number,
                    ];
                }),
            ];
        });

        return Inertia::render('ShowTickets', [
            'bookings'  => $bookings,
        ]);
    }
}
