<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin
        $admin = User::factory()->create([
            'first_name' => 'LegacySafe',
            'last_name' => '',
            'email' => 'legacysafe@example.com',
        ]);
        $admin->assignRole(User::ROLE_ADMIN);

        $client = User::factory()->create([
            'first_name' => 'Jack',
            'last_name' => 'Simmons',
            'email' => 'jack@example.com',
        ]);
        $admin->assignRole(User::ROLE_CLIENT);

        // Create Professional
        $professional = User::factory()->create([
            'first_name' => 'Fodens',
            'last_name' => 'Solicitors',
            'email' => 'fodens@example.com',
        ]);
        $professional->assignRole(User::ROLE_PROFESSIONAL);

        // Create Regular User
        $user = User::factory()->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
        ]);
        $user->assignRole(User::ROLE_USER);
    }
}
