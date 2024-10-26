<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call the RolesAndPermissionsSeeder
        $this->call(UserSeeder::class);
        // Call the RolesAndPermissionsSeeder
        $this->call(RolesAndPermissionsSeeder::class);
    }
}
