<?php

namespace Database\Seeders;

use App\Enums\PermissionEnum;
use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (PermissionEnum::cases() as $permission) {
            Permission::create([
                'name'          => $permission
            ]);
        }

        foreach (RoleEnum::cases() as $role) {
            Role::create([
                'name'          => $role
            ]);
        }

        $role = Role::findByName(RoleEnum::USER->value);

        $user               = User::create([
            'name'          => 'User',
            'email'         => 'user@gmail.com',
            'password'      => bcrypt('12345678'),
            'phone_number'  => '1234567890',
        ]);

        $admin              = User::create([
            'name'          => 'Admin',
            'email'         => 'admin@gmail.com',
            'password'      => bcrypt('12345678'),
            'phone_number'  => '1234567890',
        ]);

        $user->assignRole(RoleEnum::USER);
        $admin->assignRole(RoleEnum::ADMIN);
    }
}
