<?php

namespace App\Http\Controllers;

use App\Models\FuelRequest;
use App\Models\Vehicle;
use App\Models\User;
use App\Models\Fuel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'month'); // default is month

    // Define date range
    $start = match ($filter) {
        'month' => Carbon::now()->startOfMonth(),
        'quarter' => Carbon::now()->subMonths(3)->startOfMonth(),
        'semi' => Carbon::now()->subMonths(6)->startOfMonth(),
        'year' => Carbon::now()->startOfYear(),
        default => Carbon::now()->startOfMonth()
    };

    $fuelTypeData = FuelRequest::select('fuel_id', DB::raw('SUM(amount) as total'))
        ->where('date', '>=', $start)
        ->groupBy('fuel_id')
        ->with('fuel')
        ->get();

    $vehicleFuelUsage = FuelRequest::select('vehicle_id', DB::raw('SUM(amount) as total'))
        ->where('date', '>=', $start)
        ->groupBy('vehicle_id')
        ->with('vehicle')
        ->get();

    // Fuel usage compared to each vehicle's average
    $vehiclePerformance = Vehicle::with(['fuelRequests' => function ($q) use ($start) {
        $q->where('date', '>=', $start);
    }])->get();

    $performanceData = $vehiclePerformance->map(function ($vehicle) {
        $total = $vehicle->fuelRequests->sum('amount');
        $count = $vehicle->fuelRequests->count();
        $average = $count ? round($total / $count, 2) : 0;

        return [
            'vehicle' => $vehicle->name,
            'total' => $total,
            'average' => $average,
        ];
    });
//dd($fuelTypeData, $vehicleFuelUsage, $performanceData);

    return view('dashboard', [
        'totalRequests' => FuelRequest::count(),
        'TotalTypesofServicesDistrubited' => FuelRequest::all()->groupBy('fuel')->count(),
        'vehicles' => Vehicle::count(),
        'vehicle_types' => Vehicle::all()->groupBy('vehicle_type')->count(),
        'users' => User::count(),
        'fuels' => Fuel::count(),
        'fuelTypeData' => $fuelTypeData,
        'vehicleFuelUsage' => $vehicleFuelUsage,
        'performanceData' => $performanceData,
        'filter' => $filter,
    ]);

    }
}

