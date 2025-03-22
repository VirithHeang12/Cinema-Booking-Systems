<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieSubtitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $movieSubtitles = [
            [
                'movie_id'          => 1,
                'language_id'       => 1,
            ],
            [
                'movie_id'          => 2,
                'language_id'       => 1,
            ],
            [
                'movie_id'          => 3,
                'language_id'       => 1,
            ],
            [
                'movie_id'          => 4,
                'language_id'       => 1,
            ],
        ];

        foreach ($movieSubtitles as $movieSubtitle) {
            \App\Models\MovieSubtitle::create($movieSubtitle);
        }
    }
}
