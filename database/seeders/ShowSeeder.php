<?php

namespace Database\Seeders;

use App\Models\MovieSubtitle;
use Carbon\Carbon;
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
        $screenTypeId   = [1, 2, 3, 4, 5, 6];
        $halls          = [1, 2, 3];
        $shows          = [];

        foreach ($this->generateDateArrayUsingCollection(15) as $date) {
            // Generate random show times for this date
            $showTimes = $this->generateRandomShowTimes($date);

            // For each show time, select random movies (not all movies will show at each time)
            foreach ($showTimes as $showTime) {
                // Randomly select a subset of movie subtitles for this show time
                $selectedMovies = $movieSubtitles->random(rand(1, min(5, $movieSubtitles->count())));

                foreach ($selectedMovies as $movieSubtitle) {
                    $shows[] = [
                        'movie_subtitle_id' => $movieSubtitle->id,
                        'hall_id'           => $halls[array_rand($halls)],
                        'screen_type_id'    => $screenTypeId[array_rand($screenTypeId)],
                        'show_time'         => $showTime->format('Y-m-d H:i:s'),
                        'status'            => 'Scheduled',
                    ];
                }
            }
        }

        foreach ($shows as $show) {
            \App\Models\Show::create($show);
        }
    }

    /**
     * Generate random show times for a specific date
     *
     * @param Carbon $date
     * @return array
     */
    private function generateRandomShowTimes(Carbon $date)
    {
        // Define standard show time slots
        $standardTimes = ['10:00', '13:00', '16:00', '19:00', '22:00'];

        // Generate a random number of shows for this day (2-5)
        $numShows = rand(2, 5);

        // Randomly pick show times from standard slots
        $selectedSlots = array_rand(array_flip($standardTimes), $numShows);

        // Convert selected slots to Carbon instances
        $showTimes = [];
        foreach ((array)$selectedSlots as $timeSlot) {
            $showTimes[] = Carbon::parse($date->format('Y-m-d') . ' ' . $timeSlot);
        }

        return $showTimes;
    }

    /**
     * Generate an array of dates for the next 15 days.
     *
     * @param int $days
     *
     * @return \Illuminate\Support\Collection
     */
    private function generateDateArrayUsingCollection($days = 15)
    {
        return collect(range(0, $days - 1))
            ->map(function ($day) {
                return Carbon::today()->addDays($day);
            });
    }
}
