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

        $role->givePermissionTo([
            PermissionEnum::CREATE_LANGUAGE,
            PermissionEnum::VIEW_ANY_LANGUAGES,
            PermissionEnum::VIEW_LANGUAGE,
            PermissionEnum::CREATE_CLASSIFICATION,
            PermissionEnum::VIEW_ANY_CLASSIFICATIONS,
            PermissionEnum::VIEW_CLASSIFICATION,
            PermissionEnum::CREATE_COUNTRY,
            PermissionEnum::VIEW_ANY_COUNTRIES,
            PermissionEnum::VIEW_COUNTRY,
            PermissionEnum::CREATE_HALL_TYPE,
            PermissionEnum::VIEW_ANY_HALL_TYPES,
            PermissionEnum::VIEW_HALL_TYPE,
            PermissionEnum::CREATE_GENRE,
            PermissionEnum::VIEW_ANY_GENRES,
            PermissionEnum::VIEW_GENRE,
            PermissionEnum::CREATE_MOVIE,
            PermissionEnum::VIEW_ANY_MOVIES,
            PermissionEnum::VIEW_MOVIE,
            PermissionEnum::CREATE_HALL,
            PermissionEnum::VIEW_ANY_HALLS,
            PermissionEnum::VIEW_HALL,
            PermissionEnum::VIEW_SHOW,
            PermissionEnum::VIEW_ANY_SHOWS,
        ]);

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
