<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieGenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $movieGenres = [
            [
                'movie_id'  => 1,
                'genre_id'  => 1,
            ],
            [
                'movie_id'  => 1,
                'genre_id'  => 2,
            ],
            [
                'movie_id'  => 1,
                'genre_id'  => 3,
            ],
            [
                'movie_id'  => 2,
                'genre_id'  => 1,
            ],
            [
                'movie_id'  => 2,
                'genre_id'  => 2,
            ],
            [
                'movie_id'  => 3,
                'genre_id'  => 1,
            ],
            [
                'movie_id'  => 3,
                'genre_id'  => 2,
            ],
            [
                'movie_id'  => 4,
                'genre_id'  => 1,
            ],
            [
                'movie_id'  => 4,
                'genre_id'  => 2,
            ],
        ];

        foreach ($movieGenres as $movieGenre) {
            \App\Models\MovieGenre::create($movieGenre);
        }
    }
}
