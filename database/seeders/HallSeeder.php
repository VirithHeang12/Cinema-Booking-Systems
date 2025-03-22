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
     */
    public function run(): void
    {
        $halls = [
            [
                'name'          => 'Hall A',
                'description'   => 'Hall A Description',
                'hall_type_id'  => 1,
            ],
            [
                'name'          => 'Hall B',
                'description'   => 'Hall B Description',
                'hall_type_id'  => 2,
            ],
            [
                'name'          => 'Hall C',
                'description'   => 'Hall C Description',
                'hall_type_id'  => 3,
            ],
        ];

        foreach ($halls as $hall) {
            \App\Models\Hall::create($hall);
        }
    }
}
