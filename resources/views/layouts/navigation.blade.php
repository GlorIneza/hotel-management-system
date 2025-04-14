<nav class="bg-white shadow-lg fixed w-full z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('hotel.index') }}" class="text-2xl font-bold text-indigo-600">
                        {{ config('app.name', 'Hotel Management System') }}
                    </a>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                    <a href="{{ route('hotel.index') }}" 
                       class="inline-flex items-center px-1 pt-1 text-gray-900 hover:text-indigo-600 transition-colors duration-200">
                        Home
                    </a>
                    <a href="{{ route('rooms.index') }}" 
                       class="inline-flex items-center px-1 pt-1 text-gray-900 hover:text-indigo-600 transition-colors duration-200">
                        Rooms
                    </a>
                    <a href="{{ route('bookings.index') }}" 
                       class="inline-flex items-center px-1 pt-1 text-gray-900 hover:text-indigo-600 transition-colors duration-200">
                        Bookings
                    </a>
                    <a href="#amenities" 
                       class="inline-flex items-center px-1 pt-1 text-gray-900 hover:text-indigo-600 transition-colors duration-200">
                        Amenities
                    </a>
                    <a href="#contact" 
                       class="inline-flex items-center px-1 pt-1 text-gray-900 hover:text-indigo-600 transition-colors duration-200">
                        Contact
                    </a>
                    @auth
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" 
                               class="inline-flex items-center px-1 pt-1 text-gray-900 hover:text-indigo-600 transition-colors duration-200">
                                <i class="fas fa-user-shield mr-1"></i> Admin
                            </a>
                        @endif
                    @endauth
                </div>
            </div>

            <div class="flex items-center">
                @auth
                    <div class="hidden sm:ml-6 sm:flex sm:items-center">
                        <div class="ml-3 relative" x-data="{ open: false }">
                            <div>
                                <button @click="open = !open" class="flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <span class="sr-only">Open user menu</span>
                                    <i class="fas fa-user-circle text-2xl text-gray-400"></i>
                                </button>
                            </div>

                            <div x-show="open" 
                                 @click.away="open = false"
                                 class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                                <div class="px-4 py-2 text-sm text-gray-700 border-b border-gray-200">
                                    <div class="font-medium">{{ Auth::user()->name }}</div>
                                    <div class="text-gray-500">{{ Auth::user()->email }}</div>
                                </div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('login') }}" 
                           class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Login
                        </a>
                        <a href="{{ route('register') }}" 
                           class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Register
                        </a>
                    </div>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="flex items-center sm:hidden">
                <button type="button" 
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                        x-data="{ open: false }"
                        @click="open = !open">
                    <span class="sr-only">Open main menu</span>
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div class="sm:hidden" x-show="open" @click.away="open = false">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('hotel.index') }}" 
               class="block pl-3 pr-4 py-2 text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50">
                Home
            </a>
            <a href="{{ route('rooms.index') }}" 
               class="block pl-3 pr-4 py-2 text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50">
                Rooms
            </a>
            <a href="{{ route('bookings.index') }}" 
               class="block pl-3 pr-4 py-2 text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50">
                Bookings
            </a>
            <a href="#amenities" 
               class="block pl-3 pr-4 py-2 text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50">
                Amenities
            </a>
            <a href="#contact" 
               class="block pl-3 pr-4 py-2 text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50">
                Contact
            </a>
            @auth
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" 
                       class="block pl-3 pr-4 py-2 text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50">
                        <i class="fas fa-user-shield mr-1"></i> Admin Dashboard
                    </a>
                @endif
                <div class="px-4 py-2 text-sm text-gray-700 border-b border-gray-200">
                    <div class="font-medium">{{ Auth::user()->name }}</div>
                    <div class="text-gray-500">{{ Auth::user()->email }}</div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" 
                            class="block w-full text-left pl-3 pr-4 py-2 text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" 
                   class="block pl-3 pr-4 py-2 text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50">
                    Login
                </a>
                <a href="{{ route('register') }}" 
                   class="block pl-3 pr-4 py-2 text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50">
                    Register
                </a>
            @endauth
        </div>
    </div>
</nav>

<!-- Add padding to account for fixed navigation -->
<div class="pt-16"></div> 