<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shows = [
            [
                'movie_subtitle_id' => 1,
                'hall_id'           => 1,
                'screen_type_id'    => 1,
                'show_time'         => '2021-01-01 10:00:00',
                'status'            => 'Scheduled',
            ],
            [
                'movie_subtitle_id' => 1,
                'hall_id'           => 1,
                'screen_type_id'    => 1,
                'show_time'         => '2021-01-01 13:00:00',
                'status'            => 'Scheduled',
            ],
            [
                'movie_subtitle_id' => 1,
                'hall_id'           => 1,
                'screen_type_id'    => 1,
                'show_time'         => '2021-01-01 16:00:00',
                'status'            => 'Scheduled',
            ],
            [
                'movie_subtitle_id' => 1,
                'hall_id'           => 1,
                'screen_type_id'    => 1,
                'show_time'         => '2021-01-01 19:00:00',
                'status'            => 'Scheduled',
            ],
            [
                'movie_subtitle_id' => 1,
                'hall_id'           => 1,
                'screen_type_id'    => 1,
                'show_time'         => '2021-01-01 22:00:00',
                'status'            => 'Scheduled',
            ],
            [
                'movie_subtitle_id' => 2,
                'hall_id'           => 1,
                'screen_type_id'    => 1,
                'show_time'         => '2021-01-02 10:00:00',
                'status'            => 'Scheduled',
            ],
            [
                'movie_subtitle_id' => 2,
                'hall_id'           => 1,
                'screen_type_id'    => 1,
                'show_time'         => '2021-01-02 13:00:00',
                'status'            => 'Scheduled',
            ],
            [
                'movie_subtitle_id' => 2,
                'hall_id'           => 1,
                'screen_type_id'    => 1,
                'show_time'         => '2021-01-02 16:00:00',
                'status'            => 'Scheduled',
            ],
            [
                'movie_subtitle_id' => 2,
                'hall_id'           => 1,
                'screen_type_id'    => 1,
                'show_time'         => '2021-01-02 19:00:00',
                'status'            => 'Scheduled',
            ],
            [
                'movie_subtitle_id' => 2,
                'hall_id'           => 1,
                'screen_type_id'    => 1,
                'show_time'         => '2021-01-02 22:00:00',
                'status'            => 'Scheduled',
            ],
            [
                'movie_subtitle_id' => 3,
                'hall_id'           => 1,
                'screen_type_id'    => 1,
                'show_time'         => '2021-01-03 10:00:00',
                'status'            => 'Scheduled',
            ],
            [
                'movie_subtitle_id' => 3,
                'hall_id'           => 1,
                'screen_type_id'    => 1,
                'show_time'         => '2021-01-03 13:00:00',
                'status'            => 'Scheduled',
            ],
            [
                'movie_subtitle_id' => 3,
                'hall_id'           => 1,
                'screen_type_id'    => 1,
                'show_time'         => '2021-01-03 16:00:00',
                'status'            => 'Scheduled',
            ],
        ];

        foreach ($shows as $show) {
            \App\Models\Show::create($show);
        }
    }
}
