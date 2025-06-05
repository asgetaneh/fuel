<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Office;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $drivers = Driver::with('office')->paginate(10);
    return view('drivers.index', compact('drivers'));
}

public function create()
{
    $offices = Office::all();
     return view('drivers.create', compact('offices'));
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        // 'office_id' => 'required|exists:offices,id',
    ]);

    Driver::create($request->all());

    return redirect()->route('drivers.index')->with('success', 'Driver created successfully!');
}

public function show(Driver $driver)
{
    return view('drivers.show', compact('driver'));
}

public function edit(Driver $driver)
{
    $offices = Office::all();
    return view('drivers.edit', compact('driver', 'offices'));
}

public function update(Request $request, Driver $driver)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'office_id' => 'required|exists:offices,id',
    ]);


    $driver->update($request->all());

    return redirect()->route('drivers.index')->with('success', 'Driver updated successfully!');
}

public function destroy(Driver $driver)
{
    $driver->delete();
    return redirect()->route('drivers.index')->with('success', 'Driver deleted successfully!');
}

}
