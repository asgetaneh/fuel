<?php

namespace App\Http\Controllers;

use App\Models\FuelRequest;
use App\Models\FuelDistribute;
use App\Models\Vehicle;
use App\Models\Fuel;
use App\Models\Station;
use App\Models\FuelRequestReason;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\VehicleType;

class FuelRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requests = FuelRequest::latest()->paginate(10);
        return view('fuel_requests.index', compact('requests'));
    }

    public function create()
    {
        return view('fuel_requests.create', [
            'vehicles' => Vehicle::all(),
            'vehicletypes' => VehicleType::all(),
            'fuels' => Fuel::all(),
            'stations' => Station::all(),
            'reasons' => FuelRequestReason::all(),
            'users' => User::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'total_km_covered_by_vehicle' => 'nullable|integer',
            'fuel_id' => 'required|exists:fuels,id',
            'amount' => 'required|numeric',
            //'date' => 'required|date',
           // 'station_id' => 'required|exists:stations,id',
            'service_reason_id' => 'required|exists:fuel_request_reasons,id',
            // 'requested_by' => 'required|exists:users,id',
            // 'approved_by' => 'required|exists:users,id',
            'notes' => 'nullable|string',
        ]);
        //dd($validated);
         $validated['date'] = now()->toDateString(); // or now() for timestamp

        // Set received_by automatically from authenticated user
        // Adjust this depending on your auth setup and user fields:
        // Example: $request->user()->name OR $request->user()->id
        $validated['requested_by'] = auth()->user()->id ?? 'Unknown User';
         $validated['approved_by'] = auth()->user()->id ?? 'Unknown User';
         FuelRequest::create($validated);

        return redirect()->route('fuel-requests.index')->with('success', 'Fuel request added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(FuelRequest $fuelRequest)
    {
        //
            return view('fuel_requests.show', compact('fuelRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FuelRequest $fuel_request)
    {
        //
        return view('fuel_requests.edit', [
            'fuel_request' => $fuel_request,
            'vehicles' => Vehicle::all(),
            'fuels' => Fuel::all(),
            'stations' => Station::all(),
            'reasons' => FuelRequestReason::all(),
            'users' => User::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FuelRequest $fuel_request)
    {
        //
         $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'total_km_covered_by_vehicle' => 'required|integer',
            'fuel_id' => 'required|exists:fuels,id',
            'amount' => 'required|numeric',
            'station_id' => 'required|exists:stations,id',
            'service_reason_id' => 'required|exists:fuel_request_reasons,id',
            'notes' => 'nullable|string',
        ]);

        $fuel_request->update($validated);

    return redirect()->route('fuel-requests.index')->with('success', 'Fuel request updated.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FuelRequest $fuelRequests)
    {
        //
    }

    // FuelRequestController.php

    public function approve(Request $request, FuelRequest $fuel_request)
    {
        // Authorization check (example using Laravel gates)
        //$this->authorize('approve', $fuel_request);
        $fuel_request->update([
            'status' => 1,
            'approved_by' => auth()->id(),
            'updated_at' => now(),
        ]);
//dd($fuel_request);
        return redirect()->back()
            ->with('success', 'Fuel request has been approved successfully');
    }

    public function reject(Request $request, FuelRequest $fuel_request)
    {
        // Authorization check
        $this->authorize('reject', $fuel_request);

        $validated = $request->validate([
            'rejection_notes' => 'nullable|string|max:255'
        ]);

        $fuel_request->update([
            'status' => 'rejected',
            'approved_by' => auth()->id(),
            'rejected_at' => now(),
            'rejection_notes' => $validated['rejection_notes'] ?? null,
        ]);

        return redirect()->back()
            ->with('success', 'Fuel request has been rejected');
    }
}
