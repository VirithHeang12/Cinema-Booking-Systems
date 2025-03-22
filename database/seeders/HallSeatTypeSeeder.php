<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HallSeatTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hallSeatTypes = [
            [
                'hall_id'               => 1,
                'seat_type_id'          => 1,
                'maximum_capacity'      => 100,
            ],
            [
                'hall_id'               => 1,
                'seat_type_id'          => 2,
                'maximum_capacity'      => 50,
            ],
            [
                'hall_id'               => 1,
                'seat_type_id'          => 3,
                'maximum_capacity'      => 25,
            ],
            [
                'hall_id'               => 2,
                'seat_type_id'          => 1,
                'maximum_capacity'      => 100,
            ],
            [
                'hall_id'               => 2,
                'seat_type_id'          => 2,
                'maximum_capacity'      => 50,
            ],
            [
                'hall_id'               => 2,
                'seat_type_id'          => 3,
                'maximum_capacity'      => 25,
            ],
            [
                'hall_id'               => 3,
                'seat_type_id'          => 1,
                'maximum_capacity'      => 100,
            ],
            [
                'hall_id'               => 3,
                'seat_type_id'          => 2,
                'maximum_capacity'      => 50,
            ],
            [
                'hall_id'               => 3,
                'seat_type_id'          => 3,
                'maximum_capacity'      => 25,
            ],
        ];

        foreach ($hallSeatTypes as $hallSeatType) {
            \App\Models\HallSeatType::create($hallSeatType);
        }
    }
}
