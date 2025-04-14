<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="bg-indigo-800 text-white w-64 py-6 flex-shrink-0">
            <div class="px-6">
                <h1 class="text-2xl font-bold">Admin Panel</h1>
                <p class="text-sm text-indigo-300 mt-1">Welcome, {{ Auth::user()->name }}</p>
            </div>
            <nav class="mt-8">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-indigo-700 {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-700' : '' }}">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </a>
                <a href="{{ route('admin.bookings.index') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-indigo-700 {{ request()->routeIs('admin.bookings.*') ? 'bg-indigo-700' : '' }}">
                    <i class="fas fa-calendar-check mr-3"></i>
                    Bookings
                </a>
                <a href="{{ route('admin.users.index') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-indigo-700 {{ request()->routeIs('admin.users.*') ? 'bg-indigo-700' : '' }}">
                    <i class="fas fa-users mr-3"></i>
                    Users
                </a>
                <a href="{{ route('admin.reports.index') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-indigo-700 {{ request()->routeIs('admin.reports.*') ? 'bg-indigo-700' : '' }}">
                    <i class="fas fa-chart-bar mr-3"></i>
                    Reports
                </a>
                <a href="{{ route('admin.settings.index') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-indigo-700 {{ request()->routeIs('admin.settings.*') ? 'bg-indigo-700' : '' }}">
                    <i class="fas fa-cog mr-3"></i>
                    Settings
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Top Navigation -->
            <div class="bg-white shadow-sm">
                <div class="flex items-center justify-between px-6 py-4">
                    <h2 class="text-xl font-semibold text-gray-800">@yield('title', 'Dashboard')</h2>
                    <div class="flex items-center">
                        <div class="relative">
                            <button class="flex items-center text-gray-700 hover:text-gray-900">
                                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" alt="Profile" class="w-8 h-8 rounded-full mr-2">
                                <span>{{ Auth::user()->name }}</span>
                                <i class="fas fa-chevron-down ml-2"></i>
                            </button>
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 hidden">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <div class="p-6">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <script>
        // Toggle dropdown menu
        document.querySelector('.relative button').addEventListener('click', function() {
            this.nextElementSibling.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.relative')) {
                document.querySelector('.relative .hidden').classList.add('hidden');
            }
        });
    </script>
</body>
</html> 