<div class="bg-white shadow-lg rounded-lg p-6 mb-8">
    <form action="{{ route('rooms.index') }}" method="GET" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label for="check_in" class="block text-sm font-medium text-gray-700">Check In</label>
                <input type="date" name="check_in" id="check_in" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                       value="{{ request('check_in') }}"
                       min="{{ date('Y-m-d') }}">
            </div>
            <div>
                <label for="check_out" class="block text-sm font-medium text-gray-700">Check Out</label>
                <input type="date" name="check_out" id="check_out" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                       value="{{ request('check_out') }}"
                       min="{{ date('Y-m-d', strtotime('+1 day')) }}">
            </div>
            <div>
                <label for="guests" class="block text-sm font-medium text-gray-700">Guests</label>
                <select name="guests" id="guests" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Select guests</option>
                    @for($i = 1; $i <= 4; $i++)
                        <option value="{{ $i }}" {{ request('guests') == $i ? 'selected' : '' }}>{{ $i }} Guest{{ $i > 1 ? 's' : '' }}</option>
                    @endfor
                </select>
            </div>
            <div>
                <label for="price_range" class="block text-sm font-medium text-gray-700">Price Range</label>
                <select name="price_range" id="price_range" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Any Price</option>
                    <option value="0-100" {{ request('price_range') == '0-100' ? 'selected' : '' }}>$0 - $100</option>
                    <option value="100-200" {{ request('price_range') == '100-200' ? 'selected' : '' }}>$100 - $200</option>
                    <option value="200-300" {{ request('price_range') == '200-300' ? 'selected' : '' }}>$200 - $300</option>
                    <option value="300+" {{ request('price_range') == '300+' ? 'selected' : '' }}>$300+</option>
                </select>
            </div>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <i class="fas fa-search mr-2"></i> Search Rooms
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkIn = document.getElementById('check_in');
        const checkOut = document.getElementById('check_out');

        // Set minimum check-out date based on check-in date
        checkIn.addEventListener('change', function() {
            const minCheckOut = new Date(this.value);
            minCheckOut.setDate(minCheckOut.getDate() + 1);
            checkOut.min = minCheckOut.toISOString().split('T')[0];
            
            // If check-out date is before new minimum, update it
            if (checkOut.value && new Date(checkOut.value) <= new Date(this.value)) {
                checkOut.value = minCheckOut.toISOString().split('T')[0];
            }
        });

        // Validate check-out date when changed
        checkOut.addEventListener('change', function() {
            if (checkIn.value && new Date(this.value) <= new Date(checkIn.value)) {
                const minCheckOut = new Date(checkIn.value);
                minCheckOut.setDate(minCheckOut.getDate() + 1);
                this.value = minCheckOut.toISOString().split('T')[0];
            }
        });
    });
</script>
@endpush 