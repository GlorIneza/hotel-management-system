<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AdminSeeder::class);

        // User::factory(10)->create();

        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'is_admin' => true,
            'phone' => '1234567890',
            'address' => '123 Admin Street'
        ]);

        // Create regular user
        User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
            'is_admin' => false,
            'phone' => '0987654321',
            'address' => '456 User Avenue'
        ]);

        // Run other seeders
        $this->call([
            RoomSeeder::class,
            BookingSeeder::class,
            MaintenanceRequestSeeder::class,
        ]);
    }
}
