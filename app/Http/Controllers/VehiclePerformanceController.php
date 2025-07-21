<?php

namespace App\Http\Controllers;

use App\Models\VehiclePerformance;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;

class VehiclePerformanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $performances = VehiclePerformance::with('vehicle')->paginate(10);
        return view('vehicle_performances.index', compact('performances'));
    }

    public function create()
    {
        $vehicles = Vehicle::all();
        return view('vehicle_performances.create', compact('vehicles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'average_distance_km_per_hr' => 'nullable|numeric',
            'average_km_per_litter' => 'nullable|numeric',
            'speed_per_km_hr' => 'nullable|numeric',
            'description' => 'nullable|string',
            // 'date' => 'required|date',
        ]);
        //dd($request->all());
        VehiclePerformance::create([
            ...$request->only([
                'vehicle_id',
                'average_distance_km_per_hr',
                'average_km_per_litter',
                'description',
            ]),
            'speed_per_km_hr' => $request->input('average_distance_km_per_hr', 0), // Default to 0 if not provided
            'date'=> now()->toDateString(),
            'recorded_by' => Auth::id(),
        ]);

        return redirect()->route('vehicle-performances.index')->with('success', 'Performance recorded.');
    }

    public function show(VehiclePerformance $vehiclePerformance)
    {
        return view('vehicle_performances.show', compact('vehiclePerformance'));
    }

    public function edit(VehiclePerformance $vehiclePerformance)
    {
        $vehicles = Vehicle::all();
        return view('vehicle_performances.edit', compact('vehiclePerformance', 'vehicles'));
    }

    public function update(Request $request, VehiclePerformance $vehiclePerformance)
    {
        $data = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'average_distance_km_per_hr' => 'nullable|numeric',
            'average_km_per_litter' => 'nullable|numeric',
            // 'speed_per_km_hr' => 'nullable|numeric',
            'description' => 'nullable|string',
            // 'date' => 'required|date',
        ]);
        $data['recorded_by'] = Auth::id(); // Update recorded_by to current user
        $data['speed_per_km_hr'] = $request->input('average_distance_km_per_hr', 0); // Default to 0 if not provided
        $data['date'] = now()->toDateString(); // Update date to current date

        $vehiclePerformance->update($data);

        return redirect()->route('vehicle-performances.index')->with('success', 'Performance updated.');
    }

    public function destroy(VehiclePerformance $vehiclePerformance)
    {
        $vehiclePerformance->delete();
        return redirect()->route('vehicle-performances.index')->with('success', 'Performance deleted.');
    }
}
