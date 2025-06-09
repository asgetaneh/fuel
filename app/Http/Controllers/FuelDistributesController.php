<?php

namespace App\Http\Controllers;

use App\Models\FuelDistributes;
use App\Models\FuelRequest;
use App\Models\Vehicle;
use App\Models\Fuel;
use App\Models\Station;
use App\Models\FuelRequestReason;
use App\Models\User;
use Illuminate\Http\Request;

class FuelDistributesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fuelDistributes = FuelDistributes::with(['fuelRequest', 'vehicle', 'station', 'provider'])->paginate();
        return view('fuel_distributes.index', compact('fuelDistributes'));
    }

    public function create()
    {
        return view('fuel_distributes.create', [
            'fuelRequests' => FuelRequest::all(),
            'vehicles' => Vehicle::all(),
            'fuels' => Fuel::all(),
            'stations' => Station::all(),
            'reasons' => FuelRequestReason::all(),
            'users' => User::all(),
        ]);
    }

   public function store(Request $request)
{
    $validated = $request->validate([
        'distribution_type' => 'required|in:1,2',
        'amount' => 'numeric|min:0',
        'notes' => 'nullable|string|max:1000',
        'request_date' => 'required|date',
        'requested_by' => 'required|exists:users,id',
        'approved_by' => 'required|exists:users,id',
    ]);

    if ($request->distribution_type == '1') {
        // WITH REQUEST
        $request->validate([
            'fuel_request_id' => 'required|exists:fuel_requests,id',
        ]);

        $fuelDistribute = new FuelDistributes();
        $fuelDistribute->distribution_type = 1;
        $fuelDistribute->fuel_request_id = $request->fuel_request_id;
        $fuelDistribute->amount = $request->amount;
        $fuelDistribute->notes = $request->notes;
        $fuelDistribute->date = $request->request_date;
        //$fuelDistribute->requested_by = $request->requested_by;
        //$fuelDistribute->approved_by = $request->approved_by;
        $fuelDistribute->provider_user_id = auth()->user()->id;
        $fuelDistribute->save();

    } elseif ($request->distribution_type == '2') {
        // DIRECT DISTRIBUTION
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'total_km_covered_by_vehicle' => 'required|numeric|min:0',
            'fuel_id' => 'required|exists:fuels,id',
            'station_id' => 'required|exists:stations,id',
            'fuel_request_reason_id' => 'exists:service_reasons,id',
        ]);

        $fuelDistribute = new FuelDistributes();
        $fuelDistribute->distribution_type = 2;
        $fuelDistribute->vehicle_id = $request->vehicle_id;
        $fuelDistribute->total_km_covered_by_vehicle = $request->total_km_covered_by_vehicle;
        $fuelDistribute->fuel_id = $request->fuel_id;
        $fuelDistribute->station_id = $request->station_id;
        $fuelDistribute->fuel_request_reason_id = $request->service_reason_id;
        $fuelDistribute->amount = $request->amount;
        $fuelDistribute->notes = $request->notes;
        $fuelDistribute->date = $request->request_date;
        $fuelDistribute->requested_by = $request->requested_by;
        $fuelDistribute->approved_by = $request->approved_by;
        $fuelDistribute->provider_user_id = auth()->user()->id; // Assuming the provider is the currently authenticated user
        $fuelDistribute->save();
    }

    return redirect()->route('fuel-distributes.index')->with('success', 'Fuel distribution saved successfully.');
}

    /**
     * Display the specified resource.
     */
    public function show(FuelDistributes $fuelDistributes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FuelDistributes $fuelDistributes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FuelDistributes $fuelDistributes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FuelDistributes $fuelDistributes)
    {
        //
    }
}
