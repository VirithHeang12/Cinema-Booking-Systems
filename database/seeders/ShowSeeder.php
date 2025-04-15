<?php

namespace Database\Seeders;

use App\Models\Hall;
use App\Models\MovieSubtitle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $movieSubtitles = MovieSubtitle::all();
        $screenTypeId   = [1, 2, 3, 4];
        $halls          = [1, 2, 3];

        foreach ($movieSubtitles as $movieSubtitle) {
            $shows[] = [
                'movie_subtitle_id' => $movieSubtitle->id,
                'hall_id'           => $halls[array_rand($halls)],
                'screen_type_id'    => $screenTypeId[array_rand($screenTypeId)],
                'show_time'         => now()->addDays(rand(0, 30))->format('Y-m-d H:i:s'),
                'status'            => 'Scheduled',
            ];
        }

        foreach ($shows as $show) {
            \App\Models\Show::create($show);
        }
    }
}
