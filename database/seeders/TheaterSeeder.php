<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TheaterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $theaters = [
            ['name' => 'Theater 1', 'address' => 'Address 1'],
            ['name' => 'Theater 2', 'address' => 'Address 2'],
            ['name' => 'Theater 3', 'address' => 'Address 3'],
            ['name' => 'Theater 4', 'address' => 'Address 4'],
            ['name' => 'Theater 5', 'address' => 'Address 5'],
        ];

        foreach ($theaters as $theater) {
            \App\Models\Theater::create($theater);
        }
    }
}
