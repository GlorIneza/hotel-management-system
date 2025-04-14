<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $query = Room::query();

        // Filter by check-in and check-out dates
        if ($request->filled(['check_in', 'check_out'])) {
            $query->whereDoesntHave('bookings', function ($q) use ($request) {
                $q->where(function ($q) use ($request) {
                    $q->whereBetween('check_in', [$request->check_in, $request->check_out])
                      ->orWhereBetween('check_out', [$request->check_in, $request->check_out])
                      ->orWhere(function ($q) use ($request) {
                          $q->where('check_in', '<=', $request->check_in)
                            ->where('check_out', '>=', $request->check_out);
                      });
                });
            });
        }

        // Filter by number of guests
        if ($request->filled('guests')) {
            $query->where('max_guests', '>=', $request->guests);
        }

        // Filter by price range
        if ($request->filled('price_range')) {
            switch ($request->price_range) {
                case '0-100':
                    $query->where('price', '<=', 100);
                    break;
                case '100-200':
                    $query->whereBetween('price', [100, 200]);
                    break;
                case '200-300':
                    $query->whereBetween('price', [200, 300]);
                    break;
                case '300+':
                    $query->where('price', '>', 300);
                    break;
            }
        }

        $rooms = $query->paginate(9);

        return view('rooms.index', compact('rooms'));
    }

    public function show(Room $room)
    {
        return view('rooms.show', compact('room'));
    }
} 