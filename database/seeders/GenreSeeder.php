<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = [
            [
                'name'        => 'Action',
                'description' => 'Fast-paced, exciting sequences with intense physical activity.'
            ],
            [
                'name'        => 'Adventure',
                'description' => 'Stories involving epic journeys and explorations.'
            ],
            [
                'name'        => 'Comedy',
                'description' => 'Humorous content meant to entertain and amuse.'
            ],
            [
                'name'        => 'Drama',
                'description' => 'Serious narratives focusing on emotional and character development.'
            ],
            [
                'name'        => 'Fantasy',
                'description' => 'Magical worlds with mythical creatures and supernatural elements.'
            ],
            [
                'name'        => 'Horror',
                'description' => 'Designed to scare, thrill, and create suspense.'
            ],
            [
                'name'        => 'Mystery',
                'description' => 'Focuses on solving puzzles or uncovering hidden secrets.'
            ],
            [
                'name'        => 'Romance',
                'description' => 'Centers around love, relationships, and emotional connections.'
            ],
            [
                'name'        => 'Science Fiction',
                'description' => 'Explores futuristic technology, space, and alternate realities.'
            ],
            [
                'name'        => 'Thriller',
                'description' => 'Fast-paced, suspenseful, and filled with tension.'
            ],
            [
                'name'        => 'Crime',
                'description' => 'Involves criminals, detectives, and the justice system.'
            ],
            [
                'name'        => 'Historical',
                'description' => 'Stories set in the past, often based on real events.'
            ],
            [
                'name'        => 'War',
                'description' => 'Depicts battles, military conflicts, and their effects.'
            ],
            [
                'name'        => 'Western',
                'description' => 'Set in the American Old West, featuring cowboys and gunfights.'
            ],
            [
                'name'        => 'Supernatural',
                'description' => 'Includes ghosts, demons, and unexplainable phenomena.'
            ],
            [
                'name'        => 'Dark Fantasy',
                'description' => 'A blend of fantasy elements with horror and dark themes.'
            ],
            [
                'name'        => 'Dystopian',
                'description' => 'Explores oppressive societies and futuristic depravation.'
            ],
            [
                'name'        => 'Cyberpunk',
                'description' => 'High-tech worlds with advanced AI, cybernetics, and dystopian settings.'
            ],
            [
                'name'        => 'Steampunk',
                'description' => 'A retro-futuristic genre combining steam-powered technology and Victorian aesthetics.'
            ],
            [
                'name'        => 'Psychological Thriller',
                'description' => 'Focuses on the human mind, paranoia, and manipulation.'
            ],
            [
                'name'        => 'Epic',
                'description' => 'Grand-scale storytelling with legendary heroes and vast adventures.'
            ],
            [
                'name'        => 'Noir',
                'description' => 'Dark, cynical crime dramas with morally ambiguous characters.'
            ],
            [
                'name'        => 'Musical',
                'description' => 'Features song and dance as central storytelling elements.'
            ],
            [
                'name'        => 'Sports',
                'description' => 'Focuses on athletic competition and personal perseverance.'
            ],
            [
                'name'        => 'Survival',
                'description' => 'Centers on characters struggling against extreme conditions.'
            ],
            [
                'name'        => 'Slice of Life',
                'description' => 'Depicts everyday, real-life experiences and challenges.'
            ],
            [
                'name'        => 'Paranormal',
                'description' => 'Involves supernatural beings like vampires, werewolves, and spirits.'
            ],
            [
                'name'        => 'Political',
                'description' => 'Explores governmental systems, power struggles, and revolutions.'
            ],
            [
                'name'        => 'Gothic',
                'description' => 'A blend of horror and romance with dark, eerie atmospheres.'
            ]
        ];

        foreach ($genres as $genre) {
            Genre::create($genre);
        }

    }
}
