<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Movie;
use App\Models\MovieSubtitle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieSubtitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
            Language::where('name', 'English')->first(),
            Language::where('name', 'Khmer')->first(),
        ];

        $movies    = Movie::all();

        foreach ($movies as $movie) {
            foreach ($languages as $language) {
                MovieSubtitle::create([
                    'movie_id'          => $movie->id,
                    'language_id'       => $language->id,
                ]);
            }
        }
    }
}
