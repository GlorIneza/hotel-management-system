<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    public function run()
    {
        $rooms = [
            [
                'name' => 'Deluxe Suite',
                'description' => 'Spacious suite with ocean view',
                'price_per_night' => 299.99,
                'room_number' => '101',
                'status' => 'available',
                'capacity' => 2,
                'amenities' => json_encode(['WiFi', 'TV', 'Mini Bar', 'Ocean View'])
            ],
            [
                'name' => 'Executive Room',
                'description' => 'Modern room with city view',
                'price_per_night' => 199.99,
                'room_number' => '102',
                'status' => 'available',
                'capacity' => 2,
                'amenities' => json_encode(['WiFi', 'TV', 'Work Desk', 'City View'])
            ],
            [
                'name' => 'Family Suite',
                'description' => 'Large suite perfect for families',
                'price_per_night' => 399.99,
                'room_number' => '103',
                'status' => 'available',
                'capacity' => 4,
                'amenities' => json_encode(['WiFi', 'TV', 'Kitchen', 'Balcony'])
            ]
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
} 