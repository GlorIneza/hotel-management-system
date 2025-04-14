@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-xl overflow-hidden">
            <!-- Header -->
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold text-gray-900">Booking Details</h2>
                    <span class="px-4 py-2 rounded-full text-sm font-semibold 
                        @if($booking->status === 'confirmed') bg-green-100 text-green-800
                        @elseif($booking->status === 'cancelled') bg-red-100 text-red-800
                        @else bg-yellow-100 text-yellow-800 @endif">
                        {{ ucfirst($booking->status) }}
                    </span>
                </div>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Room Information -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Room Information</h3>
                        <div class="bg-gray-50 rounded-lg overflow-hidden">
                            <img src="{{ asset('storage/' . $booking->room->image) }}" 
                                 alt="{{ $booking->room->name }}" 
                                 class="w-full h-64 object-cover">
                            <div class="p-4">
                                <h4 class="text-xl font-semibold text-gray-900">{{ $booking->room->name }}</h4>
                                <p class="text-gray-600 mt-1">{{ $booking->room->description }}</p>
                                <div class="mt-4 flex items-center text-gray-600">
                                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <span>Capacity: {{ $booking->room->capacity }} guests</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Booking Details -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Booking Details</h3>
                        <div class="bg-gray-50 rounded-lg p-4 space-y-4">
                            <div>
                                <p class="text-sm text-gray-500">Booking ID</p>
                                <p class="font-medium">#{{ $booking->id }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Check-in Date</p>
                                <p class="font-medium">{{ $booking->check_in_date->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Check-out Date</p>
                                <p class="font-medium">{{ $booking->check_out_date->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Number of Guests</p>
                                <p class="font-medium">{{ $booking->number_of_guests }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Total Price</p>
                                <p class="font-medium text-indigo-600">${{ number_format($booking->total_price, 2) }}</p>
                            </div>
                            @if($booking->special_requests)
                                <div>
                                    <p class="text-sm text-gray-500">Special Requests</p>
                                    <p class="font-medium">{{ $booking->special_requests }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="mt-8 flex justify-end space-x-4">
                    <a href="{{ route('bookings.index') }}" 
                       class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Back to Bookings
                    </a>
                    @if(Auth::user()->isAdmin() && $booking->status === 'pending')
                        <form action="{{ route('bookings.update-status', $booking) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="confirmed">
                            <button type="submit" 
                                    class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Confirm Booking
                            </button>
                        </form>
                        <form action="{{ route('bookings.update-status', $booking) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="cancelled">
                            <button type="submit" 
                                    class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                Cancel Booking
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 