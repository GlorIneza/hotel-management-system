@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Available Rooms</h1>
    
    <x-room-search />

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($rooms as $room)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="{{ asset('storage/' . $room->image) }}" alt="{{ $room->name }}" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-2">{{ $room->name }}</h2>
                    <p class="text-gray-600 mb-4">{{ Str::limit($room->description, 100) }}</p>
                    
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center">
                            <i class="fas fa-user-friends text-gray-500 mr-2"></i>
                            <span class="text-gray-600">Max {{ $room->max_guests }} guests</span>
                        </div>
                        <div class="text-indigo-600 font-semibold">${{ number_format($room->price, 2) }}/night</div>
                    </div>

                    <div class="flex items-center mb-4">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star {{ $i <= $room->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                        @endfor
                    </div>

                    <a href="{{ route('rooms.show', $room) }}" 
                       class="block w-full text-center bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 transition duration-300">
                        View Details
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <i class="fas fa-search text-gray-400 text-4xl mb-4"></i>
                <p class="text-gray-600">No rooms found matching your criteria.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $rooms->links() }}
    </div>
</div>
@endsection
