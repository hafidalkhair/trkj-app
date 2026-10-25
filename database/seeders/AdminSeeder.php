<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // The Filament admin panel authenticates against the default 'web'
        // guard, which resolves to the User model — not the separate Admin
        // model/table. Seed a User here so the panel actually has a login.
        User::updateOrCreate(
            ['email' => 'admin@trkj.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
            ]
        );
    }
}
