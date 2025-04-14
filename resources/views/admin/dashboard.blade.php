@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <!-- Total Bookings -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-indigo-100 text-indigo-500">
                <i class="fas fa-calendar-check text-2xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-500">Total Bookings</p>
                <p class="text-2xl font-semibold">{{ $totalBookings }}</p>
            </div>
        </div>
        <div class="mt-4">
            <div class="flex items-center text-sm">
                <span class="text-green-500">
                    <i class="fas fa-arrow-up"></i> {{ $bookingGrowth }}%
                </span>
                <span class="text-gray-500 ml-2">from last month</span>
            </div>
        </div>
    </div>

    <!-- Pending Bookings -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-500">
                <i class="fas fa-clock text-2xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-500">Pending Bookings</p>
                <p class="text-2xl font-semibold">{{ $pendingBookings }}</p>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('admin.bookings.index', ['status' => 'pending']) }}" class="text-sm text-indigo-500 hover:text-indigo-700">
                View all pending →
            </a>
        </div>
    </div>

    <!-- Total Revenue -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-500">
                <i class="fas fa-dollar-sign text-2xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-500">Total Revenue</p>
                <p class="text-2xl font-semibold">${{ number_format($totalRevenue, 2) }}</p>
            </div>
        </div>
        <div class="mt-4">
            <div class="flex items-center text-sm">
                <span class="text-green-500">
                    <i class="fas fa-arrow-up"></i> {{ $revenueGrowth }}%
                </span>
                <span class="text-gray-500 ml-2">from last month</span>
            </div>
        </div>
    </div>

    <!-- Total Users -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-500">
                <i class="fas fa-users text-2xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-500">Total Users</p>
                <p class="text-2xl font-semibold">{{ $totalUsers }}</p>
            </div>
        </div>
        <div class="mt-4">
            <div class="flex items-center text-sm">
                <span class="text-green-500">
                    <i class="fas fa-arrow-up"></i> {{ $userGrowth }}%
                </span>
                <span class="text-gray-500 ml-2">from last month</span>
            </div>
        </div>
    </div>
</div>

<!-- Recent Bookings -->
<div class="bg-white rounded-lg shadow mb-6">
    <div class="p-6 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900">Recent Bookings</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Booking ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Guest</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Room</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check-in</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($recentBookings as $booking)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            #{{ $booking->id }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $booking->user->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $booking->room->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $booking->check_in_date->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @if($booking->status === 'confirmed') bg-green-100 text-green-800
                                @elseif($booking->status === 'cancelled') bg-red-100 text-red-800
                                @else bg-yellow-100 text-yellow-800 @endif">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <a href="{{ route('admin.bookings.show', $booking) }}" class="text-indigo-600 hover:text-indigo-900">View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                            No recent bookings found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Quick Actions -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
        <div class="space-y-3">
            <a href="{{ route('admin.bookings.create') }}" class="flex items-center text-indigo-600 hover:text-indigo-900">
                <i class="fas fa-plus-circle mr-2"></i>
                Create New Booking
            </a>
            <a href="{{ route('admin.users.create') }}" class="flex items-center text-indigo-600 hover:text-indigo-900">
                <i class="fas fa-user-plus mr-2"></i>
                Add New User
            </a>
            <a href="{{ route('admin.reports.index') }}" class="flex items-center text-indigo-600 hover:text-indigo-900">
                <i class="fas fa-file-alt mr-2"></i>
                Generate Reports
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Today's Schedule</h3>
        <div class="space-y-3">
            @forelse($todayCheckIns as $booking)
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-900">{{ $booking->user->name }}</p>
                        <p class="text-sm text-gray-500">Room {{ $booking->room->room_number }}</p>
                    </div>
                    <span class="text-sm text-gray-500">{{ $booking->check_in_date->format('h:i A') }}</span>
                </div>
            @empty
                <p class="text-sm text-gray-500">No check-ins scheduled for today.</p>
            @endforelse
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Maintenance Requests</h3>
        <div class="space-y-3">
            @forelse($pendingMaintenance as $request)
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-900">Room {{ $request->room->room_number }}</p>
                        <p class="text-sm text-gray-500">{{ $request->title }}</p>
                    </div>
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                        {{ ucfirst($request->priority) }}
                    </span>
                </div>
            @empty
                <p class="text-sm text-gray-500">No pending maintenance requests.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection

<?php
use Illuminate\Support\Facades\Hash;

$password = Hash::make('Adelphine@123'); // Hash the password