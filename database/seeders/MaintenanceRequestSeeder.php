<?php

namespace Database\Seeders;

use App\Models\MaintenanceRequest;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Seeder;

class MaintenanceRequestSeeder extends Seeder
{
    public function run()
    {
        $rooms = Room::all();
        $staff = User::where('is_admin', true)->get();
        
        $requests = [
            [
                'room_id' => $rooms->random()->id,
                'title' => 'AC Not Working',
                'description' => 'Air conditioning unit is not cooling properly',
                'priority' => 'high',
                'status' => 'pending',
                'assigned_to' => $staff->random()->id
            ],
            [
                'room_id' => $rooms->random()->id,
                'title' => 'Leaky Faucet',
                'description' => 'Bathroom faucet is dripping',
                'priority' => 'low',
                'status' => 'in_progress',
                'assigned_to' => $staff->random()->id
            ],
            [
                'room_id' => $rooms->random()->id,
                'title' => 'Broken TV',
                'description' => 'TV remote not working and screen has issues',
                'priority' => 'medium',
                'status' => 'pending',
                'assigned_to' => null
            ],
            [
                'room_id' => $rooms->random()->id,
                'title' => 'WiFi Issues',
                'description' => 'Poor WiFi signal in the room',
                'priority' => 'medium',
                'status' => 'completed',
                'assigned_to' => $staff->random()->id,
                'completed_at' => now()->subHours(2)
            ]
        ];

        foreach ($requests as $request) {
            MaintenanceRequest::create($request);
        }
    }
} 