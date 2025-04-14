<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    public function run()
    {
        $rooms = Room::all();
        $users = User::all();
        
        // Create some past bookings
        for ($i = 0; $i < 5; $i++) {
            $checkIn = Carbon::now()->subDays(rand(1, 30));
            $checkOut = $checkIn->copy()->addDays(rand(1, 5));
            
            Booking::create([
                'user_id' => $users->random()->id,
                'room_id' => $rooms->random()->id,
                'check_in_date' => $checkIn,
                'check_out_date' => $checkOut,
                'number_of_guests' => rand(1, 4),
                'status' => rand(0, 1) ? 'confirmed' : 'cancelled',
                'special_requests' => rand(0, 1) ? 'Late check-in requested' : null,
                'total_price' => rand(200, 1000)
            ]);
        }

        // Create some upcoming bookings
        for ($i = 0; $i < 5; $i++) {
            $checkIn = Carbon::now()->addDays(rand(1, 30));
            $checkOut = $checkIn->copy()->addDays(rand(1, 5));
            
            Booking::create([
                'user_id' => $users->random()->id,
                'room_id' => $rooms->random()->id,
                'check_in_date' => $checkIn,
                'check_out_date' => $checkOut,
                'number_of_guests' => rand(1, 4),
                'status' => rand(0, 1) ? 'confirmed' : 'pending',
                'special_requests' => rand(0, 1) ? 'Early check-in requested' : null,
                'total_price' => rand(200, 1000)
            ]);
        }
    }
} 