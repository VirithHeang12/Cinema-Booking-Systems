<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\Movie;

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
                'description'       => 'Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency.',
                'release_date'      => '2024-09-23',
                'duration'          => 142,
                'country_id'        => 1,
                'spoken_language_id' => 1,
                'rating'            => 9.3,
                'trailer_url'       => 'https://www.youtube.com/watch?v=6hB3S9bIaco',
                'thumbnail_url'     => Storage::url('images/movie-1.png'),
                'classification_id' => 1
            ],
            [
                'title'             => 'The Godfather',
                'description'       => 'The aging patriarch of an organized crime dynasty transfers control of his clandestine empire to his reluctant son.',
                'release_date'      => '2023-03-24',
                'duration'          => 175,
                'country_id'        => 1,
                'spoken_language_id' => 1,
                'rating'            => 9.2,
                'trailer_url'       => 'https://www.youtube.com/watch?v=sY1S34973zA',
                'thumbnail_url'     => Storage::url('images/movie-2.png'),
                'classification_id' => 1
            ],
            [
                'title'             => 'The Dark Knight',
                'description'       => 'When the menace known as the Joker wreaks havoc and chaos on the people of Gotham, Batman must accept one of the greatest psychological and physical tests of his ability to fight injustice.',
                'release_date'      => '2021-07-18',
                'duration'          => 152,
                'country_id'        => 1,
                'spoken_language_id' => 1,
                'rating'            => 9.0,
                'trailer_url'       => 'https://www.youtube.com/watch?v=EXeTwQWrcwY',
                'thumbnail_url'     => Storage::url('images/movie-3.png'),
                'classification_id' => 2
            ],
            [
                'title'             => 'The Lord of the Rings: The Return of the King',
                'description'       => 'Gandalf and Aragorn lead the World of the West against Sauron\'s army to draw his gaze from Frodo and Sam as they approach Mount Doom with the One Ring.',
                'release_date'      => '2022-12-17',
                'duration'          => 201,
                'country_id'        => 1,
                'spoken_language_id' => 1,
                'rating'            => 8.9,
                'trailer_url'       => 'https://www.youtube.com/watch?v=r5X-hFf6Bwo',
                'thumbnail_url'     => Storage::url('images/movie-4.png'),
                'classification_id' => 2
            ],
            [
                'title'             => 'Inception',
                'description'       => 'A thief who steals corporate secrets through the use of dream-sharing technology is given the inverse task of planting an idea into the mind of a C.E.O.',
                'release_date'      => '2020-07-16',
                'duration'          => 148,
                'country_id'        => 1,
                'spoken_language_id' => 1,
                'rating'            => 8.8,
                'trailer_url'       => 'https://www.youtube.com/watch?v=YoHD9XEInc0',
                'thumbnail_url'     => Storage::url('images/movie-5.png'),
                'classification_id' => 2
            ],
            [
                'title'             => 'Fight Club',
                'description'       => 'An insomniac office worker and a devil-may-care soapmaker form an underground fight club that evolves into something much, much more.',
                'release_date'      => '2024-10-15',
                'duration'          => 139,
                'country_id'        => 1,
                'spoken_language_id' => 1,
                'rating'            => 8.8,
                'trailer_url'       => 'https://www.youtube.com/watch?v=SUXWAEX2jlg',
                'thumbnail_url'     => Storage::url('images/movie-6.png'),
                'classification_id' => 2
            ],
            [
                'title'             => 'Forrest Gump',
                'description'       => 'The presidencies of Kennedy and Johnson, the Vietnam War, the Watergate scandal and other historical events unfold from the perspective',
                'release_date'      => '2023-07-06',
                'duration'          => 142,
                'country_id'        => 1,
                'spoken_language_id' => 1,
                'rating'            => 8.8,
                'trailer_url'       => 'https://www.youtube.com/watch?v=bLvqoHBptjg',
                'thumbnail_url'     => Storage::url('images/movie-7.png'),
                'classification_id' => 2
            ],
            [
                'title'             => 'Pulp Fiction',
                'description'       => 'The lives of two mob hitmen, a boxer, a gangster\'s wife, and a pair of diner bandits intertwine in four tales of violence and redemption.',
                'release_date'      => '2024-05-21',
                'duration'          => 154,
                'country_id'        => 3,
                'spoken_language_id' => 4,
                'rating'            => 8.7,
                'trailer_url'       => 'https://www.youtube.com/watch?v=s7EdQ4FqbhY',
                'thumbnail_url'     => Storage::url('images/movie-8.jpg'),
                'classification_id' => 3
            ],
            [
                'title'             => 'The Matrix',
                'description'       => 'A computer hacker learns about the true nature of his reality and his role in the war against its controllers.',
                'release_date'      => '1999-03-31',
                'duration'          => 136,
                'country_id'        => 7,
                'spoken_language_id' => 9,
                'rating'            => 8.7,
                'trailer_url'       => 'https://www.youtube.com/watch?v=vKQi3bBA1y8',
                'thumbnail_url'     => Storage::url('images/movie-9.jpg'),
                'classification_id' => 3
            ],
            [
                'title'             => 'Interstellar',
                'description'       => 'A team of explorers travel through a wormhole in space in an attempt to ensure humanity\'s survival.',
                'release_date'      => '2014-11-07',
                'duration'          => 169,
                'country_id'        => 10,
                'spoken_language_id' => 11,
                'rating'            => 8.6,
                'trailer_url'       => 'https://www.youtube.com/watch?v=zSWdZVtXT7E',
                'thumbnail_url'     => Storage::url('images/movie-10.jpg'),
                'classification_id' => 2
            ],
            [
                'title'             => 'Gladiator',
                'description'       => 'A former Roman General sets out to exact vengeance against the corrupt emperor who murdered his family and sent him into slavery.',
                'release_date'      => '2000-05-05',
                'duration'          => 155,
                'country_id'        => 1,
                'spoken_language_id' => 1,
                'rating'            => 8.5,
                'trailer_url'       => 'https://www.youtube.com/watch?v=owK1qxDselE',
                'thumbnail_url'     => Storage::url('images/movie-11.jpg'),
                'classification_id' => 3
            ],
            [
                'title'             => 'The Prestige',
                'description'       => 'Two stage magicians engage in a bitter rivalry to create the ultimate illusion, pushing the boundaries of obsession and sacrifice.',
                'release_date'      => '2006-10-20',
                'duration'          => 130,
                'country_id'        => 10,
                'spoken_language_id' => 20,
                'rating'            => 8.5,
                'trailer_url'       => 'https://www.youtube.com/watch?v=o4gHCmTQDVI',
                'thumbnail_url'     => Storage::url('images/movie-12.jpg'),
                'classification_id' => 4
            ],
            [
                'title'             => 'Whiplash',
                'description'       => 'A promising young drummer enrolls at a cut-throat music conservatory where his dreams of greatness are mentored by an instructor who will stop at nothing.',
                'release_date'      => '2014-10-10',
                'duration'          => 106,
                'country_id'        => 50,
                'spoken_language_id' => 50,
                'rating'            => 8.5,
                'trailer_url'       => 'https://www.youtube.com/watch?v=7d_jQycdQGo',
                'thumbnail_url'     => Storage::url('images/movie-13.jpg'),
                'classification_id' => 4
            ],
            [
                'title'             => 'Parasite',
                'description'       => 'Greed and class discrimination threaten the symbiotic relationship between a wealthy family and a destitute clan.',
                'release_date'      => '2019-05-30',
                'duration'          => 132,
                'country_id'        => 32,
                'spoken_language_id' => 32,
                'rating'            => 8.6,
                'trailer_url'       => 'https://www.youtube.com/watch?v=5xH0HfJHsaY',
                'thumbnail_url'     => Storage::url('images/movie-14.jpg'),
                'classification_id' => 6
            ],
            [
                'title'             => 'Django Unchained',
                'description'       => 'With the help of a German bounty hunter, a freed slave sets out to rescue his wife from a brutal Mississippi plantation owner.',
                'release_date'      => '2012-12-25',
                'duration'          => 165,
                'country_id'        => 33,
                'spoken_language_id' => 33,
                'rating'            => 8.4,
                'trailer_url'       => 'https://www.youtube.com/watch?v=eUdM9vrCbow',
                'thumbnail_url'     => Storage::url('images/movie-15.jpg'),
                'classification_id' => 5
            ],
            [
                'title'             => 'How to Train Your Dragon',
                'description'       => 'A young Viking forms an unlikely bond with a dragon, changing the fate of his people forever.',
                'release_date'      => '2025-06-13',
                'duration'          => 140,
                'country_id'        => 10,
                'spoken_language_id' => 10,
                'rating'            => 8.8,
                'trailer_url'       => 'https://www.youtube.com/watch?v=22w7z_lT6YM',
                'thumbnail_url'     => Storage::url('images/movie-16.png'),
                'classification_id' => 4
            ],
            [
                'title'             => 'Wolf Man',
                'description'       => 'A man is bitten by a mysterious creature and begins to undergo a terrifying transformation during the full moon.',
                'release_date'      => '2025-10-31',
                'duration'          => 110,
                'country_id'        => 8,
                'spoken_language_id' => 8,
                'rating'            => 7.2,
                'trailer_url'       => 'https://www.youtube.com/watch?v=kAw4PH2IQgo',
                'thumbnail_url'     => Storage::url('images/movie-17.png'),
                'classification_id' => 4
            ],
            [
                'title'             => 'Back Action',
                'description'       => 'An ex-agent returns from retirement to uncover a global conspiracy that threatens the world order.',
                'release_date'      => '2023-06-22',
                'duration'          => 128,
                'country_id'        => 9,
                'spoken_language_id' => 9,
                'rating'            => 7.9,
                'trailer_url'       => 'https://www.youtube.com/watch?v=DntFQ0HMZ98',
                'thumbnail_url'     => Storage::url('images/movie-18.jpg'),
                'classification_id' => 5
            ],
            [
                'title'             => 'Captain America: Brave New World',
                'description'       => 'Sam Wilson takes up the shield as the new Captain America, facing new global threats and personal challenges.',
                'release_date'      => '2025-02-14',
                'duration'          => 145,
                'country_id'        => 1,
                'spoken_language_id' => 1,
                'rating'            => 8.1,
                'trailer_url'       => 'https://www.youtube.com/watch?v=1pHDWnXmK7Y',
                'thumbnail_url'     => Storage::url('images/movie-19.jpg'),
                'classification_id' => 5
            ],
            [
                'title'             => 'Paddington in Peru',
                'description'       => 'Paddington returns to Peru to visit his beloved Aunt Lucy, where he embarks on an unexpected jungle adventure.',
                'release_date'      => '2024-11-08',
                'duration'          => 105,
                'country_id'        => 2,
                'spoken_language_id' => 2,
                'rating'            => 7.6,
                'trailer_url'       => 'https://www.youtube.com/watch?v=NTvudSGfHRI',
                'thumbnail_url'     => Storage::url('images/movie-20.png'),
                'classification_id' => 3
            ],
            [
                'title'             => 'Snow White',
                'description'       => 'A reimagining of the classic fairytale, where Snow White must fight for justice in her kingdom.',
                'release_date'      => '2025-03-21',
                'duration'          => 110,
                'country_id'        => 3,
                'spoken_language_id' => 3,
                'rating'            => 6.9,
                'trailer_url'       => 'https://www.youtube.com/watch?v=iV46TJKL8cU',
                'thumbnail_url'     => Storage::url('images/movie-21.png'),
                'classification_id' => 3
            ],
            [
                'title'             => 'Mickey 17',
                'description'       => 'An expendable crew member on a space mission begins to question his purpose and identity.',
                'release_date'      => '2025-01-31',
                'duration'          => 120,
                'country_id'        => 4,
                'spoken_language_id' => 4,
                'rating'            => 8.3,
                'trailer_url'       => 'https://www.youtube.com/watch?v=osYpGSz_0i4',
                'thumbnail_url'     => Storage::url('images/movie-22.png'),
                'classification_id' => 6
            ],
            [
                'title'             => 'Thunderbolts',
                'description'       => 'A team of anti-heroes and former villains unite under a secret government mission.',
                'release_date'      => '2025-07-25',
                'duration'          => 130,
                'country_id'        => 5,
                'spoken_language_id' => 5,
                'rating'            => 8.0,
                'trailer_url'       => 'https://www.youtube.com/watch?v=hUUszE29jS0',
                'thumbnail_url'     => Storage::url('images/movie-23.jpg'),
                'classification_id' => 5
            ],
            [
                'title'             => 'Lilo & Stitch',
                'description'       => 'A young Hawaiian girl adopts a strange alien creature, unaware of his powerful past.',
                'release_date'      => '2025-06-27',
                'duration'          => 100,
                'country_id'        => 6,
                'spoken_language_id' => 6,
                'rating'            => 7.4,
                'trailer_url'       => 'https://www.youtube.com/watch?v=VWqJifMMgZE',
                'thumbnail_url'     => Storage::url('images/movie-24.png'),
                'classification_id' => 3
            ],
            [
                'title'             => 'Karate Kid',
                'description'       => 'A new student learns martial arts to stand up for himself and uncover family secrets.',
                'release_date'      => '2024-12-13',
                'duration'          => 125,
                'country_id'        => 7,
                'spoken_language_id' => 7,
                'rating'            => 7.8,
                'trailer_url'       => 'https://www.youtube.com/watch?v=uPzOyzsnmio',
                'thumbnail_url'     => Storage::url('images/movie-25.png'),
                'classification_id' => 4
            ],

        ];
        foreach ($movies as $movie) {
            Movie::create($movie);
        }
    }
}
