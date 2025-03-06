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
                'show_id'       => 1,
                'seat_id'       => 3,
                'status'        => 'Available',
                'booking_id'    => 2,
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
                'booking_id'    => 4,
            ],
            [
                'show_id'       => 1,
                'seat_id'       => 6,
                'status'        => 'Available',
                'booking_id'    => 5,
            ],
            [
                'show_id'       => 1,
                'seat_id'       => 7,
                'status'        => 'Available',
                'booking_id'    => 6,
            ],
            [
                'show_id'       => 1,
                'seat_id'       => 8,
                'status'        => 'Available',
                'booking_id'    => 7,
            ],
            [
                'show_id'       => 1,
                'seat_id'       => 9,
                'status'        => 'Available',
                'booking_id'    => 8,
            ],
            [
                'show_id'       => 1,
                'seat_id'       => 10,
                'status'        => 'Available',
                'booking_id'    => 9,
            ],
            [
                'show_id'       => 1,
                'seat_id'       => 11,
                'status'        => 'Available',
                'booking_id'    => 10,
            ],
            [
                'show_id'       => 1,
                'seat_id'       => 12,
                'status'        => 'Available',
                'booking_id'    => 11,
            ],
            [
                'show_id'       => 1,
                'seat_id'       => 13,
                'status'        => 'Available',
                'booking_id'    => 12,
            ],
        ];
    }
}
