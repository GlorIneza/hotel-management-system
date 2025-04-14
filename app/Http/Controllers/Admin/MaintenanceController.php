<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MaintenanceRequest;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function index()
    {
        $requests = MaintenanceRequest::with(['room', 'assignedTo'])
            ->latest()
            ->paginate(10);

        return view('admin.maintenance.index', compact('requests'));
    }

    public function create()
    {
        $rooms = Room::all();
        $staff = User::where('is_admin', true)->get();
        return view('admin.maintenance.create', compact('rooms', 'staff'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high,urgent',
            'assigned_to' => 'nullable|exists:users,id'
        ]);

        MaintenanceRequest::create($validated);

        return redirect()->route('admin.maintenance.index')
            ->with('success', 'Maintenance request created successfully.');
    }

    public function show(MaintenanceRequest $maintenance)
    {
        $maintenance->load(['room', 'assignedTo']);
        return view('admin.maintenance.show', compact('maintenance'));
    }

    public function edit(MaintenanceRequest $maintenance)
    {
        $rooms = Room::all();
        $staff = User::where('is_admin', true)->get();
        return view('admin.maintenance.edit', compact('maintenance', 'rooms', 'staff'));
    }

    public function update(Request $request, MaintenanceRequest $maintenance)
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high,urgent',
            'status' => 'required|in:pending,in_progress,completed,cancelled',
            'assigned_to' => 'nullable|exists:users,id'
        ]);

        if ($request->status === 'completed') {
            $validated['completed_at'] = now();
        }

        $maintenance->update($validated);

        return redirect()->route('admin.maintenance.show', $maintenance)
            ->with('success', 'Maintenance request updated successfully.');
    }

    public function destroy(MaintenanceRequest $maintenance)
    {
        $maintenance->delete();

        return redirect()->route('admin.maintenance.index')
            ->with('success', 'Maintenance request deleted successfully.');
    }
} 