<?php

// 3. TripController
namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Vehicle;
use App\Models\Driver;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function index()
    {
        $trips = Trip::with(['vehicle', 'driver'])->paginate(10);
        return view('trips.index', compact('trips'));
    }

    public function create()
    {
        $vehicles = Vehicle::all();
        $drivers = Driver::all();
        return view('trips.create', compact('vehicles', 'drivers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string',
            'from' => 'required|string',
            'to' => 'required|string',
            'vehicle_id' => 'required|exists:vehicles,id',
            'start_time' => 'required|date',
            'end_time' => 'nullable|date|after_or_equal:start_time',
        ]);

        Trip::create($validated);
        return redirect()->route('trips.index')->with('success', 'Trip created successfully.');
    }

    public function show(Trip $trip)
    {
        return view('trips.show', compact('trip'));
    }

    public function edit(Trip $trip)
    {
        $vehicles = Vehicle::all();
        $drivers = Driver::all();
        return view('trips.edit', compact('trip', 'vehicles', 'drivers'));
    }

    public function update(Request $request, Trip $trip)
    {
        $validated = $request->validate([
            'description' => 'required|string',
            'from' => 'required|string',
            'to' => 'required|string',
            'vehicle_id' => 'required|exists:vehicles,id',
            'start_time' => 'required|date',
            'end_time' => 'nullable|date|after_or_equal:start_time'
        ]);

        $trip->update($validated);
        return redirect()->route('trips.index')->with('success', 'Trip updated successfully.');
    }

    public function destroy(Trip $trip)
    {
        $trip->delete();
        return redirect()->route('trips.index')->with('success', 'Trip deleted successfully.');
    }
}
