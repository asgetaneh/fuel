<?php

namespace App\Http\Controllers;

use App\Models\StationFuelStored;
use App\Models\Station;
use App\Models\Fuel;
use Illuminate\Http\Request;

class StationFuelStoredController extends Controller
{
    public function index()
    {
        $stationFuelStored = StationFuelStored::with(['station', 'fuel'])->latest()->paginate(10);
        return view('station_fuel_stored.index', compact('stationFuelStored'));
    }

    public function create()
    {
        $stations = Station::all();
        $fuels = Fuel::all();
        return view('station_fuel_stored.create', compact('stations', 'fuels'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'station_id' => 'required|exists:stations,id',
            'fuel_id' => 'required|exists:fuels,id',
            'amount' => 'required|numeric',
            // 'date' => 'required|date',
            // 'received_by' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        // Set date automatically to today (or now)
        $validated['date'] = now()->toDateString(); // or now() for timestamp

        // Set received_by automatically from authenticated user
        // Adjust this depending on your auth setup and user fields:
        // Example: $request->user()->name OR $request->user()->id
        $validated['received_by'] = auth()->user()->name ?? 'Unknown User';

        StationFuelStored::create($validated);
        return redirect()->route('station-fuel-storeds.index')->with('success', 'Fuel storage record added.');
    }

    public function show(StationFuelStored $stationFuelStored)
    {
        $stationFuelStored->load(['station', 'fuel']);
        return view('station_fuel_stored.show', compact('stationFuelStored'));
    }

    public function edit(StationFuelStored $stationFuelStored)
    {
        $stations = Station::all();
        $fuels = Fuel::all();
        return view('station_fuel_stored.edit', compact('stationFuelStored', 'stations', 'fuels'));
    }

    public function update(Request $request, StationFuelStored $stationFuelStored)
    {
        $validated = $request->validate([
            'station_id' => 'required|exists:stations,id',
            'fuel_id' => 'required|exists:fuels,id',
            'amount' => 'required|numeric',
            // 'date' => 'required|date',
            // 'received_by' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);
        // Set date automatically to today (or now)
        $validated['date'] = now()->toDateString(); // or now() for timestamp

        // Set received_by automatically from authenticated user
        // Adjust this depending on your auth setup and user fields:
        // Example: $request->user()->name OR $request->user()->id
        $validated['received_by'] = auth()->user()->name ?? 'Unknown User';

        $stationFuelStored->update($validated);

        return redirect()->route('station-fuel-storeds.index')->with('success', 'Fuel storage record updated.');
    }

    public function destroy(StationFuelStored $stationFuelStored)
    {
        $stationFuelStored->delete();
        return redirect()->route('station-fuel-storeds.index')->with('success', 'Fuel storage record deleted.');
    }
}
