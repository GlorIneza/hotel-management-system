@extends('layouts.app')

@section('content')
<!-- Hero Section with Full-Screen Background -->
<div class="relative min-h-screen">
    <div class="absolute inset-0">
        <img class="w-full h-full object-cover transform scale-105 animate-scale" 
             src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1950&q=80" 
             alt="Luxury Hotel">
        <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/60"></div>
    </div>
    <div class="relative min-h-screen flex items-center justify-center text-center px-4">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-7xl md:text-8xl font-extrabold text-white mb-8 animate-fade-in drop-shadow-2xl tracking-tight">
                Welcome to Our Luxury Hotel
            </h1>
            <p class="text-3xl md:text-4xl text-gray-100 mb-12 animate-fade-in-up drop-shadow-xl font-light">
                Experience unparalleled comfort and luxury in our carefully curated rooms and suites.
            </p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-8 animate-fade-in-up">
                <a href="{{ route('rooms.index') }}" 
                   class="inline-flex items-center justify-center px-10 py-5 border border-transparent text-xl font-medium rounded-xl text-white bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 transform hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-2xl">
                    Explore Rooms
                </a>
                <a href="#amenities" 
                   class="inline-flex items-center justify-center px-10 py-5 border-2 border-white text-xl font-medium rounded-xl text-white hover:bg-white hover:text-gray-900 transform hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-2xl">
                    View Amenities
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Featured Section with Hover Effects -->
<div class="bg-white/95 backdrop-blur-sm py-32 relative">
    <div class="absolute inset-0 bg-gradient-to-b from-white/80 to-white/95"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-5xl font-extrabold text-gray-900 sm:text-6xl mb-6 bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-indigo-800">Featured Rooms</h2>
            <p class="text-2xl text-gray-500">Discover our most popular accommodations</p>
        </div>
        
        <div class="mt-20 grid grid-cols-1 gap-y-16 gap-x-12 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-16">
            @foreach($rooms as $room)
                <div class="group relative bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 p-6">
                    <div class="w-full min-h-72 bg-gray-200 aspect-w-1 aspect-h-1 rounded-t-2xl overflow-hidden group-hover:opacity-75 transition-opacity duration-500">
                        <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" 
                             alt="{{ $room->name }}" 
                             class="w-full h-full object-center object-cover transform group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-8">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-2xl font-medium text-gray-900 group-hover:text-indigo-600 transition-colors duration-300">
                                    {{ $room->name }}
                                </h3>
                                <p class="mt-3 text-lg text-gray-500">{{ $room->description }}</p>
                            </div>
                            <p class="text-3xl font-bold text-indigo-600">${{ number_format($room->price_per_night, 2) }}</p>
                        </div>
                        <div class="mt-8">
                            <a href="{{ route('bookings.create', ['room_id' => $room->id]) }}" 
                               class="w-full flex justify-center items-center px-8 py-4 border border-transparent text-lg font-medium rounded-xl text-white bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                                Book Now
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Amenities Section -->
<div id="amenities" class="bg-gray-50/95 backdrop-blur-sm py-32 relative">
    <div class="absolute inset-0 bg-gradient-to-b from-gray-50/80 to-gray-50/95"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-5xl font-extrabold text-gray-900 sm:text-6xl mb-6 bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-indigo-800">Hotel Amenities</h2>
            <p class="text-2xl text-gray-500">Discover what makes our hotel special</p>
        </div>
        
        <div class="mt-20 grid grid-cols-1 gap-y-12 gap-x-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-10">
            <!-- Amenity Card -->
            <div class="group relative bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                <div class="w-full min-h-72 bg-gray-200 aspect-w-1 aspect-h-1 rounded-t-2xl overflow-hidden group-hover:opacity-75 transition-opacity duration-500">
                    <img src="https://images.unsplash.com/photo-1582719478185-219d8f3a9d7b?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" 
                         alt="Infinity Pool" 
                         class="w-full h-full object-center object-cover transform group-hover:scale-110 transition-transform duration-500">
                </div>
                <div class="p-8">
                    <h3 class="text-2xl font-medium text-gray-900 group-hover:text-indigo-600 transition-colors duration-300">
                        Infinity Pool
                    </h3>
                    <p class="mt-3 text-lg text-gray-500">Enjoy our stunning infinity pool overlooking the city.</p>
                </div>
            </div>

            <!-- Repeat for other amenities -->
            <div class="group relative bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                <div class="w-full min-h-72 bg-gray-200 aspect-w-1 aspect-h-1 rounded-t-2xl overflow-hidden group-hover:opacity-75 transition-opacity duration-500">
                    <img src="https://images.unsplash.com/photo-1551892589-865f69869443?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" 
                         alt="Luxury Spa" 
                         class="w-full h-full object-center object-cover transform group-hover:scale-110 transition-transform duration-500">
                </div>
                <div class="p-8">
                    <h3 class="text-2xl font-medium text-gray-900 group-hover:text-indigo-600 transition-colors duration-300">
                        Luxury Spa
                    </h3>
                    <p class="mt-3 text-lg text-gray-500">Rejuvenate with our premium spa treatments.</p>
                </div>
            </div>

            <div class="group relative bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                <div class="w-full min-h-72 bg-gray-200 aspect-w-1 aspect-h-1 rounded-t-2xl overflow-hidden group-hover:opacity-75 transition-opacity duration-500">
                    <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" 
                         alt="Fine Dining" 
                         class="w-full h-full object-center object-cover transform group-hover:scale-110 transition-transform duration-500">
                </div>
                <div class="p-8">
                    <h3 class="text-2xl font-medium text-gray-900 group-hover:text-indigo-600 transition-colors duration-300">
                        Fine Dining
                    </h3>
                    <p class="mt-3 text-lg text-gray-500">Experience culinary excellence at our restaurants.</p>
                </div>
            </div>

            <div class="group relative bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                <div class="w-full min-h-72 bg-gray-200 aspect-w-1 aspect-h-1 rounded-t-2xl overflow-hidden group-hover:opacity-75 transition-opacity duration-500">
                    <img src="https://images.unsplash.com/photo-1599058917213-0c5c7e8f3b6b?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" 
                         alt="Fitness Center" 
                         class="w-full h-full object-center object-cover transform group-hover:scale-110 transition-transform duration-500">
                </div>
                <div class="p-8">
                    <h3 class="text-2xl font-medium text-gray-900 group-hover:text-indigo-600 transition-colors duration-300">
                        Fitness Center
                    </h3>
                    <p class="mt-3 text-lg text-gray-500">Stay fit with our state-of-the-art gym.</p>
                </div>
            </div>
        </div>
    </div>
</div>
            <!-- Conference Rooms -->
            <div class="bg-white/90 backdrop-blur-sm p-10 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 min-h-[250px] group">
                <div class="flex items-center h-full">
                    <div class="flex-shrink-0">
                        <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-indigo-100 to-indigo-200 flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
                            <i class="fas fa-conference text-4xl text-indigo-600"></i>
                        </div>
                    </div>
                    <div class="ml-8">
                        <h3 class="text-3xl font-medium text-gray-900 group-hover:text-indigo-600 transition-colors duration-300">Conference Rooms</h3>
                        <p class="mt-4 text-xl text-gray-500">Host your events in our modern meeting spaces</p>
                    </div>
                </div>
            </div>

            <!-- Parking -->
            <div class="bg-white/90 backdrop-blur-sm p-10 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 min-h-[250px] group">
                <div class="flex items-center h-full">
                    <div class="flex-shrink-0">
                        <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-indigo-100 to-indigo-200 flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
                            <i class="fas fa-parking text-4xl text-indigo-600"></i>
                        </div>
                    </div>
                    <div class="ml-8">
                        <h3 class="text-3xl font-medium text-gray-900 group-hover:text-indigo-600 transition-colors duration-300">Secure Parking</h3>
                        <p class="mt-4 text-xl text-gray-500">24/7 secure parking for your convenience</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Why Choose Us Section -->
<div class="bg-gray-50/95 backdrop-blur-sm py-32 relative">
    <div class="absolute inset-0 bg-gradient-to-b from-gray-50/80 to-gray-50/95"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-5xl font-extrabold text-gray-900 sm:text-6xl mb-6 bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-indigo-800">Why Choose Us</h2>
            <p class="text-2xl text-gray-500">Experience the difference at Luxury Hotel</p>
        </div>
        <div class="mt-20 grid grid-cols-1 gap-12 sm:grid-cols-2 lg:grid-cols-3">
            <div class="bg-white/90 backdrop-blur-sm p-10 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 min-h-[250px] group">
                <div class="flex items-center h-full">
                    <div class="flex-shrink-0">
                        <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-indigo-100 to-indigo-200 flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
                            <i class="fas fa-star text-4xl text-indigo-600"></i>
                        </div>
                    </div>
                    <div class="ml-8">
                        <h3 class="text-3xl font-medium text-gray-900 group-hover:text-indigo-600 transition-colors duration-300">5-Star Service</h3>
                        <p class="mt-4 text-xl text-gray-500">Experience luxury service at its finest</p>
                    </div>
                </div>
            </div>
            <div class="bg-white/90 backdrop-blur-sm p-10 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 min-h-[250px] group">
                <div class="flex items-center h-full">
                    <div class="flex-shrink-0">
                        <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-indigo-100 to-indigo-200 flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
                            <i class="fas fa-clock text-4xl text-indigo-600"></i>
                        </div>
                    </div>
                    <div class="ml-8">
                        <h3 class="text-3xl font-medium text-gray-900 group-hover:text-indigo-600 transition-colors duration-300">24/7 Support</h3>
                        <p class="mt-4 text-xl text-gray-500">Our staff is always here to help you</p>
                    </div>
                </div>
            </div>
            <div class="bg-white/90 backdrop-blur-sm p-10 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 min-h-[250px] group">
                <div class="flex items-center h-full">
                    <div class="flex-shrink-0">
                        <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-indigo-100 to-indigo-200 flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
                            <i class="fas fa-shield-alt text-4xl text-indigo-600"></i>
                        </div>
                    </div>
                    <div class="ml-8">
                        <h3 class="text-3xl font-medium text-gray-900 group-hover:text-indigo-600 transition-colors duration-300">Safe & Secure</h3>
                        <p class="mt-4 text-xl text-gray-500">Your safety is our top priority</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Testimonials Section -->
<div class="bg-white/95 backdrop-blur-sm py-32 relative">
    <div class="absolute inset-0 bg-gradient-to-b from-white/80 to-white/95"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-5xl font-extrabold text-gray-900 sm:text-6xl mb-6 bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-indigo-800">What Our Guests Say</h2>
            <p class="text-2xl text-gray-500">Read testimonials from our satisfied guests</p>
        </div>
        <div class="mt-20 grid grid-cols-1 gap-12 sm:grid-cols-2 lg:grid-cols-3">
            <div class="bg-gray-50/90 backdrop-blur-sm p-10 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 min-h-[300px] group">
                <div class="flex items-center mb-8">
                    <div class="flex-shrink-0">
                        <img class="h-20 w-20 rounded-2xl ring-4 ring-indigo-500 transform group-hover:scale-110 transition-transform duration-500" 
                             src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" 
                             alt="John Doe">
                    </div>
                    <div class="ml-8">
                        <h4 class="text-3xl font-medium text-gray-900 group-hover:text-indigo-600 transition-colors duration-300">John Doe</h4>
                        <div class="flex text-yellow-400 mt-3">
                            <i class="fas fa-star text-3xl"></i>
                            <i class="fas fa-star text-3xl"></i>
                            <i class="fas fa-star text-3xl"></i>
                            <i class="fas fa-star text-3xl"></i>
                            <i class="fas fa-star text-3xl"></i>
                        </div>
                    </div>
                </div>
                <p class="text-xl text-gray-500 italic">"Amazing experience! The staff was very friendly and the rooms were luxurious. Will definitely come back!"</p>
            </div>
            <div class="bg-gray-50/90 backdrop-blur-sm p-10 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 min-h-[300px] group">
                <div class="flex items-center mb-8">
                    <div class="flex-shrink-0">
                        <img class="h-20 w-20 rounded-2xl ring-4 ring-indigo-500 transform group-hover:scale-110 transition-transform duration-500" 
                             src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" 
                             alt="Jane Smith">
                    </div>
                    <div class="ml-8">
                        <h4 class="text-3xl font-medium text-gray-900 group-hover:text-indigo-600 transition-colors duration-300">Jane Smith</h4>
                        <div class="flex text-yellow-400 mt-3">
                            <i class="fas fa-star text-3xl"></i>
                            <i class="fas fa-star text-3xl"></i>
                            <i class="fas fa-star text-3xl"></i>
                            <i class="fas fa-star text-3xl"></i>
                            <i class="fas fa-star text-3xl"></i>
                        </div>
                    </div>
                </div>
                <p class="text-xl text-gray-500 italic">"The best hotel I've ever stayed in. The amenities were top-notch and the service was exceptional."</p>
            </div>
            <div class="bg-gray-50/90 backdrop-blur-sm p-10 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 min-h-[300px] group">
                <div class="flex items-center mb-8">
                    <div class="flex-shrink-0">
                        <img class="h-20 w-20 rounded-2xl ring-4 ring-indigo-500 transform group-hover:scale-110 transition-transform duration-500" 
                             src="https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" 
                             alt="Mike Johnson">
                    </div>
                    <div class="ml-8">
                        <h4 class="text-3xl font-medium text-gray-900 group-hover:text-indigo-600 transition-colors duration-300">Mike Johnson</h4>
                        <div class="flex text-yellow-400 mt-3">
                            <i class="fas fa-star text-3xl"></i>
                            <i class="fas fa-star text-3xl"></i>
                            <i class="fas fa-star text-3xl"></i>
                            <i class="fas fa-star text-3xl"></i>
                            <i class="fas fa-star text-3xl"></i>
                        </div>
                    </div>
                </div>
                <p class="text-xl text-gray-500 italic">"Perfect location, beautiful rooms, and excellent service. A truly memorable stay!"</p>
            </div>
        </div>
    </div>
</div>

<!-- Add custom animations to the layout -->
<style>
    @keyframes scale {
        0% { transform: scale(1); }
        100% { transform: scale(1.05); }
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-scale {
        animation: scale 20s infinite alternate;
    }

    .animate-fade-in {
        animation: fadeIn 1.5s ease-out;
    }

    .animate-fade-in-up {
        animation: fadeInUp 1.5s ease-out;
    }

    /* Add smooth scrolling */
    html {
        scroll-behavior: smooth;
    }

    /* Add glass effect to sections */
    .backdrop-blur-sm {
        backdrop-filter: blur(12px);
    }

    /* Add hover effects */
    .group:hover .group-hover\:scale-110 {
        transform: scale(1.1);
    }

    .group:hover .group-hover\:text-indigo-600 {
        color: #4F46E5;
    }

    /* Add gradient text effect */
    .bg-clip-text {
        -webkit-background-clip: text;
        background-clip: text;
    }

    /* Add custom shadows */
    .shadow-xl {
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .shadow-2xl {
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
</style>
@endsection
