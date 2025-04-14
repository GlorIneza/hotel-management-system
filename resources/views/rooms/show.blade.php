@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Room Details -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
                <img src="{{ asset('storage/' . $room->image) }}" alt="{{ $room->name }}" class="w-full h-96 object-cover">
                <div class="p-6">
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $room->name }}</h1>
                    
                    <div class="flex items-center mb-4">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star {{ $i <= $room->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                        @endfor
                        <span class="ml-2 text-gray-600">({{ $room->rating }}/5)</span>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="flex items-center">
                            <i class="fas fa-user-friends text-gray-500 mr-2"></i>
                            <span class="text-gray-600">Max {{ $room->max_guests }} guests</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-bed text-gray-500 mr-2"></i>
                            <span class="text-gray-600">{{ $room->bed_type }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-ruler-combined text-gray-500 mr-2"></i>
                            <span class="text-gray-600">{{ $room->size }} sq ft</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-wifi text-gray-500 mr-2"></i>
                            <span class="text-gray-600">Free WiFi</span>
                        </div>
                    </div>

                    <div class="prose max-w-none">
                        <h2 class="text-xl font-semibold mb-4">Description</h2>
                        <p class="text-gray-600">{{ $room->description }}</p>
                    </div>

                    <div class="mt-8">
                        <h2 class="text-xl font-semibold mb-4">Amenities</h2>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach($room->amenities as $amenity)
                                <div class="flex items-center">
                                    <i class="fas fa-check text-green-500 mr-2"></i>
                                    <span class="text-gray-600">{{ $amenity }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reviews Section -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Guest Reviews</h2>
                @forelse($room->reviews as $review)
                    <div class="border-b border-gray-200 pb-6 mb-6 last:border-0">
                        <div class="flex items-center mb-2">
                            <div class="flex items-center">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                @endfor
                            </div>
                            <span class="ml-2 text-gray-600">{{ $review->created_at->format('M d, Y') }}</span>
                        </div>
                        <p class="text-gray-600">{{ $review->comment }}</p>
                        <div class="mt-2 text-sm text-gray-500">By {{ $review->user->name }}</div>
                    </div>
                @empty
                    <p class="text-gray-600">No reviews yet.</p>
                @endforelse
            </div>
        </div>

        <!-- Booking Form -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-lg p-6 sticky top-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Book This Room</h2>
                <form action="{{ route('bookings.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="room_id" value="{{ $room->id }}">
                    
                    <div>
                        <label for="check_in" class="block text-sm font-medium text-gray-700">Check In</label>
                        <input type="date" name="check_in" id="check_in" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                               min="{{ date('Y-m-d') }}">
                    </div>

                    <div>
                        <label for="check_out" class="block text-sm font-medium text-gray-700">Check Out</label>
                        <input type="date" name="check_out" id="check_out" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                               min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                    </div>

                    <div>
                        <label for="guests" class="block text-sm font-medium text-gray-700">Number of Guests</label>
                        <select name="guests" id="guests" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @for($i = 1; $i <= $room->max_guests; $i++)
                                <option value="{{ $i }}">{{ $i }} Guest{{ $i > 1 ? 's' : '' }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="pt-4 border-t border-gray-200">
                        <div class="flex justify-between mb-4">
                            <span class="text-gray-600">Price per night</span>
                            <span class="font-semibold">${{ number_format($room->price, 2) }}</span>
                        </div>
                        <div class="flex justify-between mb-4">
                            <span class="text-gray-600">Number of nights</span>
                            <span class="font-semibold" id="nights">0</span>
                        </div>
                        <div class="flex justify-between text-lg font-bold">
                            <span>Total</span>
                            <span id="total">$0.00</span>
                        </div>
                    </div>

                    <button type="submit" 
                            class="w-full bg-indigo-600 text-white py-3 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300"
                            id="submit-btn">
                        <span class="flex items-center justify-center">
                            <i class="fas fa-spinner fa-spin mr-2 hidden" id="loading-icon"></i>
                            <span id="button-text">Book Now</span>
                        </span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkIn = document.getElementById('check_in');
        const checkOut = document.getElementById('check_out');
        const nights = document.getElementById('nights');
        const total = document.getElementById('total');
        const pricePerNight = {{ $room->price }};
        const form = document.querySelector('form');
        const submitBtn = document.getElementById('submit-btn');
        const loadingIcon = document.getElementById('loading-icon');
        const buttonText = document.getElementById('button-text');

        function calculateTotal() {
            if (checkIn.value && checkOut.value) {
                const start = new Date(checkIn.value);
                const end = new Date(checkOut.value);
                const diffTime = Math.abs(end - start);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                
                nights.textContent = diffDays;
                total.textContent = `$${(diffDays * pricePerNight).toFixed(2)}`;
            }
        }

        checkIn.addEventListener('change', calculateTotal);
        checkOut.addEventListener('change', calculateTotal);

        // Form submission handling
        form.addEventListener('submit', function(e) {
            if (!checkIn.value || !checkOut.value) {
                e.preventDefault();
                alert('Please select both check-in and check-out dates.');
                return;
            }

            const start = new Date(checkIn.value);
            const end = new Date(checkOut.value);
            if (end <= start) {
                e.preventDefault();
                alert('Check-out date must be after check-in date.');
                return;
            }

            // Show loading state
            submitBtn.disabled = true;
            loadingIcon.classList.remove('hidden');
            buttonText.textContent = 'Processing...';
        });
    });
</script>
@endpush
@endsection 