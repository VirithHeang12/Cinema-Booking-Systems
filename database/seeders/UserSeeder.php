<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name'          => 'John Doe',
                'email'         => 'johndoe@gmail.com',
                'password'      => bcrypt(12345678),
                'phone_number'  => '081234567890',
            ],
            [
                'name'          => 'Jane Doe',
                'email'         => 'janedoe@gmail.com',
                'password'      => bcrypt(12345678),
                'phone_number'  => '081234567891',
            ],
            [
                'name'          => 'John Smith',
                'email'         => 'johnsmith@gmail.com',
                'password'      => bcrypt(12345678),
                'phone_number'  => '081234567892',
            ],
        ];

        foreach ($users as $user) {
            \App\Models\User::create($user);
        }
    }
}
