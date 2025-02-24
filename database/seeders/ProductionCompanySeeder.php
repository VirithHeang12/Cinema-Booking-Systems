<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductionCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productionCompanies = [
            ['name' => 'Warner Bros. Pictures', 'description' => 'Warner Bros. Pictures is an American film production and distribution company.'],
            ['name' => 'Universal Pictures', 'description' => 'Universal Pictures is an American film production and distribution company.'],
            ['name' => 'Columbia Pictures', 'description' => 'Columbia Pictures is an American film production and distribution company.'],
            ['name' => 'Paramount Pictures', 'description' => 'Paramount Pictures is an American film production and distribution company.'],
            ['name' => '20th Century Fox', 'description' => '20th Century Fox is an American film production and distribution company.'],
            ['name' => 'Walt Disney Pictures', 'description' => 'Walt Disney Pictures is an American film production and distribution company.'],
            ['name' => 'Metro-Goldwyn-Mayer', 'description' => 'Metro-Goldwyn-Mayer is an American film production and distribution company.'],
            ['name' => 'Lionsgate Films', 'description' => 'Lionsgate Films is an American film production and distribution company.'],
            ['name' => 'New Line Cinema', 'description' => 'New Line Cinema is an American film production and distribution company.'],
            ['name' => 'DreamWorks Pictures', 'description' => 'DreamWorks Pictures is an American film production and distribution company.'],
        ];


        foreach ($productionCompanies as $productionCompany) {
            \App\Models\ProductionCompany::create($productionCompany);
        }
    }
}
