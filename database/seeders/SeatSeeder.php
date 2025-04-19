<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seats = [
            [
                'hall_id'       => 1,
                'seat_type_id'  => 2,
                'row'           => 'A',
                'number'        => 1,
            ],
            [
                'hall_id'       => 1,
                'seat_type_id'  => 2,
                'row'           => 'A',
                'number'        => 2,
            ],
            [
                'hall_id'       => 1,
                'seat_type_id'  => 2,
                'row'           => 'A',
                'number'        => 3,
            ],
            [
                'hall_id'       => 1,
                'seat_type_id'  => 2,
                'row'           => 'A',
                'number'        => 4,
            ],
            [
                'hall_id'       => 1,
                'seat_type_id'  => 2,
                'row'           => 'A',
                'number'        => 5,
            ],
            [
                'hall_id'       => 1,
                'seat_type_id'  => 2,
                'row'           => 'A',
                'number'        => 6,
            ],
            [
                'hall_id'       => 1,
                'seat_type_id'  => 2,
                'row'           => 'A',
                'number'        => 7,
            ],
            [
                'hall_id'       => 1,
                'seat_type_id'  => 2,
                'row'           => 'A',
                'number'        => 8,
            ],
            [
                'hall_id'       => 1,
                'seat_type_id'  => 2,
                'row'           => 'A',
                'number'        => 9,
            ],
            [
                'hall_id'       => 1,
                'seat_type_id'  => 2,
                'row'           => 'A',
                'number'        => 10,
            ],
        ];

        foreach (range('B', 'I') as $row) {
            for ($number = 1; $number <= 10; $number++) {
                for ($hall = 1; $hall <= 3; $hall++) {
                    $seats[] = [
                        'hall_id'       => $hall,
                        'seat_type_id'  => 1,
                        'row'           => $row,
                        'number'        => $number,
                    ];
                }
            }
        }

        foreach ($seats as $seat) {
            \App\Models\Seat::create($seat);
        }
    }
}
