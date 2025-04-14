<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.index');
    }

    public function bookings(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->subMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->format('Y-m-d'));

        $bookings = Booking::with(['user', 'room'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        $totalBookings = $bookings->count();
        $confirmedBookings = $bookings->where('status', 'confirmed')->count();
        $cancelledBookings = $bookings->where('status', 'cancelled')->count();
        $totalRevenue = $bookings->where('status', 'confirmed')->sum('total_price');

        return view('admin.reports.bookings', compact(
            'bookings',
            'totalBookings',
            'confirmedBookings',
            'cancelledBookings',
            'totalRevenue',
            'startDate',
            'endDate'
        ));
    }

    public function revenue(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->subMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->format('Y-m-d'));

        $revenue = Booking::where('status', 'confirmed')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, SUM(total_price) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $totalRevenue = $revenue->sum('total');
        $averageRevenue = $revenue->count() > 0 ? $totalRevenue / $revenue->count() : 0;

        // Room occupancy rates
        $rooms = Room::withCount(['bookings' => function ($query) use ($startDate, $endDate) {
            $query->where('status', 'confirmed')
                ->where(function ($q) use ($startDate, $endDate) {
                    $q->whereBetween('check_in_date', [$startDate, $endDate])
                        ->orWhereBetween('check_out_date', [$startDate, $endDate]);
                });
        }])->get();

        $totalRooms = $rooms->count();
        $occupiedRooms = $rooms->where('bookings_count', '>', 0)->count();
        $occupancyRate = $totalRooms > 0 ? ($occupiedRooms / $totalRooms) * 100 : 0;

        return view('admin.reports.revenue', compact(
            'revenue',
            'totalRevenue',
            'averageRevenue',
            'occupancyRate',
            'startDate',
            'endDate'
        ));
    }
} 