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
                'name'          => 'VIP',
                'description'   => 'Very Important Person',
                'price'         => 1000000,
            ],
            [
                'name'          => 'VVIP',
                'description'   => 'Very Very Important Person',
                'price'         => 2000000,
            ],
            [
                'name'          => 'SVIP',
                'description'   => 'Super Very Important Person',
                'price'         => 3000000,
            ],
        ];

        foreach ($seatTypes as $seatType) {
            \App\Models\SeatType::create($seatType);
        }
    }
}
