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
            PermissionSeeder::class,
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
            HallSeeder::class,
            HallSeatTypeSeeder::class,
            MovieSeeder::class,
            MovieGenreSeeder::class,
            MovieSubtitleSeeder::class,
            SeatSeeder::class,
            ShowSeeder::class,
            ShowSeatSeeder::class,
        ]);
    }
}
