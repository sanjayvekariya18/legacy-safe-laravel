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

        $client1 = User::factory()->create([
            'first_name' => 'Jack',
            'last_name' => 'Client',
            'email' => 'client1@example.com',
        ]);
        $client1->assignRole(User::ROLE_CLIENT);

        $client2 = User::factory()->create([
            'last_name' => 'Client',
            'email' => 'client2@example.com',
        ]);
        $client2->assignRole(User::ROLE_CLIENT);

        $client3 = User::factory()->create([
            'last_name' => 'Client',
            'email' => 'client3@example.com',
        ]);
        $client3->assignRole(User::ROLE_CLIENT);

        // Create Professional
        $professional1 = User::factory()->create([
            'first_name' => 'Fodens',
            'last_name' => 'Professional',
            'email' => 'professional1@example.com',
            'professional_type' => User::PROFESSIONAL_TYPE_SOLICITOR
        ]);
        $professional1->assignRole(User::ROLE_PROFESSIONAL);

        $professional2 = User::factory()->create([
            'last_name' => 'Professional',
            'email' => 'professional2@example.com',
            'professional_type' => User::PROFESSIONAL_TYPE_FINANCIAL_ADVISER
        ]);
        $professional2->assignRole(User::ROLE_PROFESSIONAL);

        $professional3 = User::factory()->create([
            'last_name' => 'Professional',
            'email' => 'professional3@example.com',
            'professional_type' => User::PROFESSIONAL_TYPE_ACCOUNTANT
        ]);
        $professional3->assignRole(User::ROLE_PROFESSIONAL);

        // Create Regular User
        $user1 = User::factory()->create([
            'first_name' => 'John',
            'last_name' => 'User',
            'email' => 'user1@example.com',
        ]);
        $user1->assignRole(User::ROLE_USER);

        $user2 = User::factory()->create([
            'last_name' => 'User',
            'email' => 'user2@example.com',
        ]);
        $user2->assignRole(User::ROLE_USER);

        $user3 = User::factory()->create([
            'last_name' => 'User',
            'email' => 'user3@example.com',
        ]);
        $user3->assignRole(User::ROLE_USER);
    }
}
