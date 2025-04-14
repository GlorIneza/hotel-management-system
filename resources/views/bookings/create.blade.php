@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-xl overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2">
                <!-- Room Image and Details -->
                <div class="relative h-64 lg:h-full">
                    <img src="{{ $room->image ? asset('storage/' . $room->image) : asset('images/default-room.jpg') }}" 
                         alt="{{ $room->name }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                        <div class="text-center text-white">
                            <h2 class="text-3xl font-bold mb-2">{{ $room->name }}</h2>
                            <p class="text-xl">${{ number_format($room->price, 2) }} / night</p>
                        </div>
                    </div>
                </div>

                <!-- Booking Form -->
                <div class="p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Complete Your Booking</h2>
                    <form action="{{ route('bookings.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="room_id" value="{{ $room->id }}">

                        <!-- Check-in Date -->
                        <div>
                            <label for="check_in_date" class="block text-sm font-medium text-gray-700">Check-in Date</label>
                            <input type="date" name="check_in_date" id="check_in_date" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                min="{{ date('Y-m-d', strtotime('+1 day')) }}" aria-label="Check-in Date">
                        </div>

                        <!-- Check-out Date -->
                        <div>
                            <label for="check_out_date" class="block text-sm font-medium text-gray-700">Check-out Date</label>
                            <input type="date" name="check_out_date" id="check_out_date" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                aria-label="Check-out Date">
                        </div>

                        <!-- Number of Guests -->
                        <div>
                            <label for="number_of_guests" class="block text-sm font-medium text-gray-700">Number of Guests</label>
                            <select name="number_of_guests" id="number_of_guests" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @for($i = 1; $i <= $room->capacity; $i++)
                                    <option value="{{ $i }}">{{ $i }} {{ $i === 1 ? 'Guest' : 'Guests' }}</option>
                                @endfor
                            </select>
                        </div>

                        <!-- Special Requests -->
                        <div>
                            <label for="special_requests" class="block text-sm font-medium text-gray-700">Special Requests</label>
                            <textarea name="special_requests" id="special_requests" rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Any special requests or requirements?"></textarea>
                        </div>

                        <!-- Price Summary -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Price Summary</h3>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Room Price per Night</span>
                                    <span class="font-medium">${{ number_format($room->price, 2) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Number of Nights</span>
                                    <span class="font-medium" id="nights-count">0</span>
                                </div>
                                <div class="border-t border-gray-200 pt-2">
                                    <div class="flex justify-between">
                                        <span class="text-lg font-medium text-gray-900">Total Price</span>
                                        <span class="text-lg font-medium text-indigo-600" id="total-price">$0.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button type="submit"
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Confirm Booking
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkInInput = document.getElementById('check_in_date');
        const checkOutInput = document.getElementById('check_out_date');
        const nightsCount = document.getElementById('nights-count');
        const totalPrice = document.getElementById('total-price');
        const roomPrice = {{ json_encode($room->price) }};

        function calculateNights() {
            const checkIn = new Date(checkInInput.value);
            const checkOut = new Date(checkOutInput.value);

            if (!checkInInput.value || !checkOutInput.value || checkOut <= checkIn) {
                nightsCount.textContent = '0';
                totalPrice.textContent = '$0.00';
                return;
            }

            const nights = Math.ceil((checkOut - checkIn) / (1000 * 60 * 60 * 24));
            nightsCount.textContent = nights;
            totalPrice.textContent = `$${(nights * roomPrice).toFixed(2)}`;
        }

        checkInInput.addEventListener('change', function() {
            checkOutInput.min = this.value;
            if (checkOutInput.value && checkOutInput.value < this.value) {
                checkOutInput.value = this.value;
            }
            calculateNights();
        });

        checkOutInput.addEventListener('change', calculateNights);

        // Set initial min value for check_out_date
        if (checkInInput.value) {
            checkOutInput.min = checkInInput.value;
        }
    });
</script>
@endpush
@endsection