<?php

namespace App\Http\Controllers;

use App\Models\VehicleType;
use Illuminate\Http\Request;

class VehicleTypeController extends Controller
{
    public function index()
    {
        $types = VehicleType::latest()->paginate(10);
        return view('vehicle_types.index', compact('types'));
    }

    public function create()
    {
        return view('vehicle_types.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        VehicleType::create($request->only('name', 'description'));
        return redirect()->route('vehicle-types.index')->with('success', 'Vehicle type added!');
    }

    public function show(VehicleType $vehicleType)
    {
        return view('vehicle_types.show', compact('vehicleType'));
    }

    public function edit(VehicleType $vehicleType)
    {
        return view('vehicle_types.edit', compact('vehicleType'));
    }

    public function update(Request $request, VehicleType $vehicleType)
    {
        $request->validate(['name' => 'required']);
        $vehicleType->update($request->only('name', 'description'));
        return redirect()->route('vehicle-types.index')->with('success', 'Vehicle type updated!');
    }

    public function destroy(VehicleType $vehicleType)
    {
        $vehicleType->delete();
        return redirect()->route('vehicle-types.index')->with('success', 'Vehicle type deleted!');
    }
}

