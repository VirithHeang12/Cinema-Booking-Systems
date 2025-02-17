<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Classification;

class ClassificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classifications = [
            ['name' => 'G', 'description' => 'General Audiences - Suitable for all ages.'],
            ['name' => 'PG', 'description' => 'Parental Guidance Suggested - Some material may not be suitable for children.'],
            ['name' => 'PG-13', 'description' => 'Parents Strongly Cautioned - Some material may be inappropriate for children under 13.'],
            ['name' => 'R', 'description' => 'Restricted - Under 17 requires accompanying parent or adult guardian.'],
            ['name' => 'NC-17', 'description' => 'Adults Only - No one 17 and under admitted.'],
            ['name' => 'U', 'description' => 'Universal - Suitable for all audiences (UK).'],
            ['name' => '12A', 'description' => '12 and over, but children under 12 can watch with an adult (UK).'],
            ['name' => '15', 'description' => 'Suitable for 15 years and older (UK).'],
            ['name' => '18', 'description' => 'Adults only - 18 and over (UK).'],
            ['name' => 'T', 'description' => 'Teen - Suitable for ages 13 and older (ESRB for video games).'],
            ['name' => 'M', 'description' => 'Mature - Recommended for ages 17 and older (ESRB for video games).'],
            ['name' => 'R-15', 'description' => 'Restricted to 15 years and older.'],
            ['name' => 'R-18', 'description' => 'Restricted to 18 years and older.'],
        ];

        foreach ($classifications as $classification) {
            Classification::create($classification);
        }
    }
}
