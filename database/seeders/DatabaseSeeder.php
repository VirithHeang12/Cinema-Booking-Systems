<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {;
        $this->call([
            BannerSeeder::class,
            ClassificationSeeder::class,
            CountrySeeder::class,
            GenreSeeder::class,
            HallTypeSeeder::class,
            LanguageSeeder::class,
            PaymentMethodSeeder::class,
            SeatTypeSeeder::class,
            ScreenTypeSeeder::class,
            BookingSeeder::class,
            HallSeatTypeSeeder::class,
            HallSeeder::class,
            MovieGenreSeeder::class,
            MovieSeeder::class,
            MovieSubtitleSeeder::class,
            SeatSeeder::class,
            ShowSeatSeeder::class,
            ShowSeeder::class,
        ]);
    }
}
