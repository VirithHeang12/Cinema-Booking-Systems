<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\ShowSeat;
use App\Models\Seat;
use Illuminate\Http\Request;

class ShowSeatController extends Controller
{
    public function index($show)
    {
        // Get the show seats with related seat details
        $seats = ShowSeat::where('show_id', $show)
            ->with('seat') // Eager load the seat relationship
            ->get()
            ->sortBy(function ($showSeat) {
                return [$showSeat->seat->row, $showSeat->seat->number];
            });

        // Group by row
        $grouped = $seats->groupBy(fn($seat) => $seat->seat->row);

        $grouped = $grouped->sortKeysDesc();

        // Map the results to return only the necessary information
        $formatted = $grouped->map(function ($rowSeats, $rowLabel) {
            return [
                'label' => $rowLabel,
                'seats' => $rowSeats->map(function ($showSeat) use ($rowLabel) {
                    return [
                        'id'     => $rowLabel . $showSeat->seat->number,
                        'number' => $showSeat->seat->number,
                        'status' => strtolower($showSeat->status), // Optional: make status lowercase
                    ];
                })->values(),
            ];
        })->values();

        return response()->json($formatted); // Return the data as JSON
    }
}
