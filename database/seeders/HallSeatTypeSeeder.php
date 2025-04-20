<?php

namespace Database\Seeders;

use App\Models\Hall;
use App\Models\SeatType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HallSeatTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $halls = Hall::all();
        $seatTypes = SeatType::all();

        foreach ($halls as $hall) {
            foreach ($seatTypes as $seatType) {
                \App\Models\HallSeatType::create([
                    'hall_id'      => $hall->id,
                    'seat_type_id' => $seatType->id,
                ]);
            }
        }
    }
}
