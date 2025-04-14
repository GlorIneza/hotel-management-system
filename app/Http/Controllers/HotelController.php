<?php

namespace App\Http\Controllers;

use App\Models\Room; // Ensure the Room model is imported
use Illuminate\Http\Request;

class HotelController extends Controller
{
    // Display a listing of the rooms.
    public function index()
    {
        $rooms = Room::all(); // Get all rooms from the database
        return view('hotel.index', compact('rooms')); // Return the view and pass rooms data
    }

    // Show the form for creating a new room.
    public function create()
    {
        return view('hotel.create'); // Return the create view
    }

    // Store a newly created room in storage.
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
        ]);

        // Create a new room record in the database
        Room::create($request->all());

        // Redirect back to the rooms index with a success message
        return redirect()->route('hotel.index')
                         ->with('success', 'Room created successfully.');
    }

    // Show the form for editing the specified room.
    public function edit(Room $room)
    {
        return view('hotel.edit', compact('room')); // Return the edit view and pass the room data
    }

    // Update the specified room in storage.
    public function update(Request $request, Room $room)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
        ]);

        // Update the room with the new data
        $room->update($request->all());

        // Redirect back to the rooms index with a success message
        return redirect()->route('hotel.index')
                         ->with('success', 'Room updated successfully.');
    }

    // Remove the specified room from storage.
    public function destroy(Room $room)
    {
        // Delete the room from the database
        $room->delete();

        // Redirect back to the rooms index with a success message
        return redirect()->route('hotel.index')
                         ->with('success', 'Room deleted successfully.');
    }
}