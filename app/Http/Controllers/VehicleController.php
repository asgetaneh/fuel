<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleType;
use App\Models\Driver;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $vehicles = Vehicle::with(['vehicleType', 'driver'])->paginate(10);
    return view('vehicles.index', compact('vehicles'));
}

public function create()
{
    $vehicleTypes = VehicleType::all();
    $drivers = Driver::all();
    return view('vehicles.create', compact('vehicleTypes', 'drivers'));
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'vehicle_type_id' => 'required',
        'registration_number' => 'required',
        'engine_number' => 'required',
        'total_seat' => 'required|integer',
    ]);
    $data = $request->all();
    $data['is_active'] = $request->has('is_active') ? 1 : 0;
    Vehicle::create($data);


    return redirect()->route('vehicles.index')->with('success', 'Vehicle created!');
}

public function show(Vehicle $vehicle)
{
    return view('vehicles.show', compact('vehicle'));
}

public function edit(Vehicle $vehicle)
{
    $vehicleTypes = VehicleType::all();
    $drivers = Driver::all();
    return view('vehicles.edit', compact('vehicle', 'vehicleTypes', 'drivers'));
}

public function update(Request $request, Vehicle $vehicle)
{
    $data = $request->all();
    $data['is_active'] = $request->has('is_active') ? 1 : 0;
    $vehicle->update($data);
    return redirect()->route('vehicles.index')->with('success', 'Vehicle updated!');
}

public function destroy(Vehicle $vehicle)
{
    $vehicle->delete();
    return redirect()->route('vehicles.index')->with('success', 'Vehicle deleted!');
}
}
