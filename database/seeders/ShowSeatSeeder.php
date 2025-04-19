<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShowSeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $showSeats = [
            [
                'show_id'       => 1,
                'seat_id'       => 2,
                'status'        => 'Available',
                'booking_id'    => 1,
            ],
            [
                'show_id'       => 3,
                'seat_id'       => 3,
                'status'        => 'Available',
                'booking_id'    => 1,
            ],
            [
                'show_id'       => 2,
                'seat_id'       => 2,
                'status'        => 'Available',
                'booking_id'    => 7,
            ],
            [
                'show_id'       => 2,
                'seat_id'       => 2,
                'status'        => 'Available',
                'booking_id'    => 3,
            ],
            [
                'show_id'       => 3,
                'seat_id'       => 7,
                'status'        => 'Available',
                'booking_id'    => 2,
            ],
            [
                'show_id'       => 1,
                'seat_id'       => 6,
                'status'        => 'Available',
                'booking_id'    => 3,
            ],
            [
                'show_id'       => 2,
                'seat_id'       => 3,
                'status'        => 'Available',
                'booking_id'    => 6,
            ],
            [
                'show_id'       => 1,
                'seat_id'       => 4,
                'status'        => 'Available',
                'booking_id'    => 3,
            ],
            [
                'show_id'       => 1,
                'seat_id'       => 5,
                'status'        => 'Available',
                'booking_id'    => 6,
            ],
            [
                'show_id'       => 4,
                'seat_id'       => 6,
                'status'        => 'Available',
                'booking_id'    => 5,
            ],
            [
                'show_id'       => 3,
                'seat_id'       => 7,
                'status'        => 'Available',
                'booking_id'    => 4,
            ],
            [
                'show_id'       => 2,
                'seat_id'       => 8,
                'status'        => 'Available',
                'booking_id'    => 4,
            ],
        ];

        // for ($seatId = 11; $seatId <= 90; $seatId++) {
        //     $showSeats[] = [
        //         'show_id'    => 14,
        //         'seat_id'    => $seatId,
        //         'status'     => 'Available',
        //         'booking_id' => null,
        //     ];
        // }

        // foreach ($showSeats as $showSeat) {
        //     \App\Models\ShowSeat::create($showSeat);
        // }
    }
}
