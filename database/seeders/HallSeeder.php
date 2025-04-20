<?php

namespace Database\Seeders;

use App\Models\Hall;
use App\Models\HallType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Creates one hall for each hall type, with sequential naming (Hall A, Hall B, etc.)
     * Ensures no duplicate hall names by appending numbers when necessary
     */
    public function run(): void
    {
        $hallTypes = HallType::all();

        // Define letters for sequential hall naming
        $letters = range('A', 'Z');
        $letterCounts = array_fill_keys($letters, 0);

        foreach ($hallTypes as $index => $hallType) {
            $letterIndex = $index % count($letters);
            $letter = $letters[$letterIndex];

            $letterCounts[$letter]++;

            $hallName = "Hall {$letter}";
            if ($letterCounts[$letter] > 1) {
                $hallName = "Hall {$letter}{$letterCounts[$letter]}";
            }

            Hall::create([
                'name'                  => $hallName,
                'description'           => "{$hallName} Description",
                'hall_type_id'          => $hallType->id,
                'maximum_seats_per_row' => 10,
            ]);
        }
    }
}
