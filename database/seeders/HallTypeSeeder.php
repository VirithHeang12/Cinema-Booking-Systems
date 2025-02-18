<?php

namespace Database\Seeders;

use App\Models\HallType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HallTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hall_types = [
            ['name' => 'Standard Hall', 'description' => 'A regular movie theater hall with standard seating, a basic sound system, and a large screen.'],
            ['name' => 'IMAX Hall', 'description' => 'Features a larger screen with higher resolution, better sound quality, and more immersive viewing.'],
            ['name' => '3D Hall', 'description' => 'Equipped with 3D technology and provides viewers with 3D glasses for a stereoscopic experience.'],
            ['name' => 'Luxury Hall', 'description' => 'Premium halls offering luxurious recliner seating, personal service, and gourmet food options.'],
            ['name' => '2D Hall', 'description' => 'A 2D hall is a flat, two-dimensional representation of a hallway or large room.'],
            ['name' => 'Movie Theater', 'description' => 'A hall designed for screening films with large screens and surround sound.'],
            ['name' => 'IMAX Theater', 'description' => 'A high-resolution theater with a giant screen and immersive sound for an enhanced viewing experience.'],
            ['name' => '3D Cinema', 'description' => 'A theater equipped with 3D projection technology for a more interactive movie experience.'],
            ['name' => '4DX Cinema', 'description' => 'A theater with motion seats and environmental effects like wind, water, and scents for an immersive experience.'],
            ['name' => 'Drive-In Theater', 'description' => 'An outdoor cinema where people watch movies from their cars on a large screen.'],
            ['name' => 'Luxury Cinema', 'description' => 'A high-end movie hall offering reclining seats, gourmet food, and personalized service.'],
            ['name' => 'Multiplex Theater', 'description' => 'A cinema complex with multiple screens showing different movies simultaneously.'],
            ['name' => 'Indie Cinema', 'description' => 'A small theater that primarily screens independent and art-house films.'],
            ['name' => 'Open-Air Cinema', 'description' => 'A movie screening setup in an outdoor setting, often in parks or rooftops.'],
            ['name' => 'Dome Theater', 'description' => 'A cinema with a curved dome screen, often used for immersive educational films and planetarium shows.'],
            ['name' => 'Silent Cinema', 'description' => 'A theater where viewers listen to the audio through wireless headphones for a quiet experience.'],
            ['name' => 'Private Screening Room', 'description' => 'An exclusive, small-scale cinema for VIP or private screenings.'],
            ['name' => 'Art House Theater', 'description' => 'A theater focusing on artistic, independent, and foreign films.'],
            ['name' => 'Festival Cinema', 'description' => 'A temporary or dedicated hall for film festivals and special screenings.'],
            ['name' => 'Retro Cinema', 'description' => 'A theater that screens classic, vintage, and old-school movies.'],
            ['name' => 'Interactive Cinema', 'description' => 'A movie theater where audiences can interact with the film using technology like voting systems.'],
            ['name' => 'Anime Theater', 'description' => 'A cinema specializing in screening anime films and series.'],
            ['name' => 'Kids Cinema', 'description' => 'A theater designed for children, featuring family-friendly movies and interactive play areas.'],
            ['name' => 'VR Cinema', 'description' => 'A theater where viewers watch movies using Virtual Reality headsets for a 360° experience.'],
            ['name' => 'Esports Cinema', 'description' => 'A hall designed for live esports event broadcasts and gaming tournaments.'],
            ['name' => 'Dine-In Cinema', 'description' => 'A movie theater where full meals and drinks are served directly to the audience.'],
            ['name' => 'Floating Cinema', 'description' => 'A unique theater set up on water, with audiences watching from boats.'],
            ['name' => 'Underground Cinema', 'description' => 'A hidden or unconventional movie screening venue, often in basements or tunnels.'],
            ['name' => 'Experimental Cinema', 'description' => 'A venue for avant-garde and experimental films with unconventional storytelling.']
        ];

        foreach ($hall_types as $hall_type) {
            HallType::create($hall_type);
        }
    }
}
