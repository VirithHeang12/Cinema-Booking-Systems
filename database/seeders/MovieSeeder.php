<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $movies = [
            [
                'title'             => 'The Shawshank Redemption',
                'description'       => 'Two imprisoned',
                'release_date'      => '2024-09-23',
                'duration'          => 142,
                'country_id'        => 1,
                'spoken_language_id'=> 1,
                'rating'            => 9.3,
                'trailer_url'       => 'https://www.youtube.com/watch?v=6hB3S9bIaco',
                'thumbnail_url'     => 'https://www.imdb.com/title/tt0111161/mediaviewer/rm10105600/',
                'classification_id' => 1
            ],
            [
                'title'             => 'The Godfather',
                'description'       => 'The aging patriarch of an organized crime dynasty transfers control of his clandestine empire to his reluctant son.',
                'release_date'      => '2023-03-24',
                'duration'          => 175,
                'country_id'        => 1,
                'spoken_language_id'=> 1,
                'rating'            => 9.2,
                'trailer_url'       => 'https://www.youtube.com/watch?v=sY1S34973zA',
                'thumbnail_url'     => 'https://www.imdb.com/title/tt0068646/mediaviewer/rm10105600/',
                'classification_id' => 1
            ],
            [
                'title'             => 'The Dark Knight',
                'description'       => 'When the menace known as the Joker wreaks havoc and chaos on the people of Gotham, Batman must accept one of the greatest psychological and physical tests of his ability to fight injustice.',
                'release_date'      => '2021-07-18',
                'duration'          => 152,
                'country_id'        => 1,
                'spoken_language_id'=> 1,
                'rating'            => 9.0,
                'trailer_url'       => 'https://www.youtube.com/watch?v=EXeTwQWrcwY',
                'thumbnail_url'     => 'https://www.imdb.com/title/tt0468569/mediaviewer/rm10105600/',
                'classification_id' => 2
            ],
            [
                'title'             => 'The Lord of the Rings: The Return of the King',
                'description'       => 'Gandalf and Aragorn lead the World of the West against Sauron\'s army to draw his gaze from Frodo and Sam as they approach Mount Doom with the One Ring.',
                'release_date'      => '2022-12-17',
                'duration'          => 201,
                'country_id'        => 1,
                'spoken_language_id'=> 1,
                'rating'            => 8.9,
                'trailer_url'       => 'https://www.youtube.com/watch?v=r5X-hFf6Bwo',
                'thumbnail_url'     => 'https://www.imdb.com/title/tt0167260/mediaviewer/rm10105600/',
                'classification_id' => 2
            ],
            [
                'title'             => 'Inception',
                'description'       => 'A thief who steals corporate secrets through the use of dream-sharing technology is given the inverse task of planting an idea into the mind of a C.E.O.',
                'release_date'      => '2020-07-16',
                'duration'          => 148,
                'country_id'        => 1,
                'spoken_language_id'=> 1,
                'rating'            => 8.8,
                'trailer_url'       => 'https://www.youtube.com/watch?v=YoHD9XEInc0',
                'thumbnail_url'     => 'https://www.imdb.com/title/tt1375666/mediaviewer/rm10105600/',
                'classification_id' => 2
            ],
            [
                'title'             => 'Fight Club',
                'description'       => 'An insomniac office worker and a devil-may-care soapmaker form an underground fight club that evolves into something much, much more.',
                'release_date'      => '2024-10-15',
                'duration'          => 139,
                'country_id'        => 1,
                'spoken_language_id'=> 1,
                'rating'            => 8.8,
                'trailer_url'       => 'https://www.youtube.com/watch?v=SUXWAEX2jlg',
                'thumbnail_url'     => 'https://www.imdb.com/title/tt0137523/mediaviewer/rm10105600/',
                'classification_id' => 2
            ],
            [
                'title'             => 'Forrest Gump',
                'description'       => 'The presidencies of Kennedy and Johnson, the Vietnam War, the Watergate scandal and other historical events unfold from the perspective',
                'release_date'      => '2023-07-06',
                'duration'          => 142,
                'country_id'        => 1,
                'spoken_language_id'=> 1,
                'rating'            => 8.8,
                'trailer_url'       => 'https://www.youtube.com/watch?v=bLvqoHBptjg',
                'thumbnail_url'     => 'https://www.imdb.com/title/tt0109830/mediaviewer/rm10105600/',
                'classification_id' => 2
            ],
        ];

        foreach ($movies as $movie) {
            \App\Models\Movie::create($movie);
        }
    }
}
