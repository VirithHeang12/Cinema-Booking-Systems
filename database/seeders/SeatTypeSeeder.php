<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeatTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seatTypes = [
            [
                'name'          => 'Regular',
                'description'   => 'Regular Seat',
                'price'         => 7,
            ],
            [
                'name'          => 'Premium',
                'description'   => 'Premium Seat',
                'price'         => 10,
            ],
            [
                'name'          => 'Luxury',
                'description'   => 'Luxury Seat',
                'price'         => 20,
            ],
        ];

        foreach ($seatTypes as $seatType) {
            \App\Models\SeatType::create($seatType);
        }
    }
}
