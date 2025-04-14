<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function create(Request $request)
    {
        $room = Room::findOrFail($request->room_id);
        return view('bookings.create', compact('room'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in_date' => 'required|date|after:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'number_of_guests' => 'required|integer|min:1',
            'special_requests' => 'nullable|string|max:500'
        ]);

        $booking = new Booking($validated);
        $booking->user_id = Auth::id();
        $booking->total_price = $booking->calculateTotalPrice();
        $booking->save();

        // Send confirmation email
        $this->sendConfirmationEmail($booking);

        return redirect()->route('bookings.show', $booking)
            ->with('success', 'Booking created successfully! Check your email for confirmation.');
    }

    public function show(Booking $booking)
    {
        $this->authorize('view', $booking);
        return view('bookings.show', compact('booking'));
    }

    public function index()
    {
        $bookings = Auth::user()->isAdmin() 
            ? Booking::with(['user', 'room'])->latest()->get()
            : Auth::user()->bookings()->with('room')->latest()->get();
        
        return view('bookings.index', compact('bookings'));
    }

    public function updateStatus(Booking $booking, Request $request)
    {
        $this->authorize('update', $booking);
        
        $validated = $request->validate([
            'status' => 'required|in:confirmed,cancelled'
        ]);

        $booking->update($validated);

        // Send status update email
        $this->sendStatusUpdateEmail($booking);

        return redirect()->route('bookings.index')
            ->with('success', 'Booking status updated successfully.');
    }

    private function sendConfirmationEmail(Booking $booking)
    {
        Mail::send('emails.booking-confirmation', ['booking' => $booking], function($message) use ($booking) {
            $message->to($booking->user->email)
                   ->subject('Booking Confirmation - ' . config('app.name'));
        });
    }

    private function sendStatusUpdateEmail(Booking $booking)
    {
        Mail::send('emails.booking-status-update', ['booking' => $booking], function($message) use ($booking) {
            $message->to($booking->user->email)
                   ->subject('Booking Status Update - ' . config('app.name'));
        });
    }
}
