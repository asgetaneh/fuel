<?php
// app/Http/Controllers/FuelRequestReasonController.php
namespace App\Http\Controllers;

use App\Models\FuelRequestReason;
use App\Models\Trip;
use Illuminate\Http\Request;

class FuelRequestReasonController extends Controller
{
    public function index()
    {
        $fuelRequestReasons = FuelRequestReason::with('trip')->get();
        return view('fuel_request_reasons.index', compact('fuelRequestReasons'));
    }

    public function create()
    {
        $trips = Trip::all();
        return view('fuel_request_reasons.create', compact('trips'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'trip_id' => 'nullable|exists:trips,id',
        ]);

        FuelRequestReason::create($validated);
        return redirect()->route('fuel-request-reasons.index')->with('success', 'Reason added');
    }

    public function show(FuelRequestReason $fuelRequestReason)
    {
        return view('fuel_request_reasons.show', compact('fuelRequestReason'));
    }

    public function edit(FuelRequestReason $fuelRequestReason)
    {
        $trips = Trip::all();
        return view('fuel_request_reasons.edit', compact('fuelRequestReason', 'trips'));
    }

    public function update(Request $request, FuelRequestReason $fuelRequestReason)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'trip_id' => 'nullable|exists:trips,id',
        ]);

        $fuelRequestReason->update($validated);
        return redirect()->route('fuel-request-reasons.index')->with('success', 'Reason updated');
    }

    public function destroy(FuelRequestReason $fuelRequestReason)
    {
        $fuelRequestReason->delete();
        return redirect()->route('fuel-request-reasons.index')->with('success', 'Reason deleted');
    }
}
