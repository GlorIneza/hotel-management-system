<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Models\MaintenanceRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Get current date and last month's date
        $now = Carbon::now();
        $lastMonth = $now->copy()->subMonth();

        // Calculate total bookings
        $totalBookings = Booking::count();

        // Calculate booking growth
        $currentMonthBookings = Booking::whereMonth('created_at', $now->month)->count();
        $lastMonthBookings = Booking::whereMonth('created_at', $lastMonth->month)->count();
        $bookingGrowth = $lastMonthBookings > 0 
            ? round((($currentMonthBookings - $lastMonthBookings) / $lastMonthBookings) * 100)
            : 0;

        // Get pending bookings
        $pendingBookings = Booking::where('status', 'pending')->count();

        // Calculate total revenue
        $totalRevenue = Booking::where('status', 'confirmed')->sum('total_price');

        // Calculate revenue growth
        $currentMonthRevenue = Booking::where('status', 'confirmed')
            ->whereMonth('created_at', $now->month)
            ->sum('total_price');
        $lastMonthRevenue = Booking::where('status', 'confirmed')
            ->whereMonth('created_at', $lastMonth->month)
            ->sum('total_price');
        $revenueGrowth = $lastMonthRevenue > 0
            ? round((($currentMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100)
            : 0;

        // Get total users
        $totalUsers = User::count();

        // Calculate user growth
        $currentMonthUsers = User::whereMonth('created_at', $now->month)->count();
        $lastMonthUsers = User::whereMonth('created_at', $lastMonth->month)->count();
        $userGrowth = $lastMonthUsers > 0
            ? round((($currentMonthUsers - $lastMonthUsers) / $lastMonthUsers) * 100)
            : 0;

        // Get recent bookings
        $recentBookings = Booking::with(['user', 'room'])
            ->latest()
            ->take(5)
            ->get();

        // Get today's check-ins
        $todayCheckIns = Booking::with(['user', 'room'])
            ->whereDate('check_in_date', $now->toDateString())
            ->where('status', 'confirmed')
            ->orderBy('check_in_date')
            ->get();

        // Get pending maintenance requests
        $pendingMaintenance = MaintenanceRequest::with('room')
            ->where('status', 'pending')
            ->orderBy('priority', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalBookings',
            'bookingGrowth',
            'pendingBookings',
            'totalRevenue',
            'revenueGrowth',
            'totalUsers',
            'userGrowth',
            'recentBookings',
            'todayCheckIns',
            'pendingMaintenance'
        ));
    }
} 