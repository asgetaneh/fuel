<?php

namespace App\Http\Controllers;

use App\Models\FuelReport;
use Illuminate\Http\Request;
use App\Models\FuelRequest;
use App\Models\Vehicle;
use App\Models\Fuel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Exports\FuelReportExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\FuelPrice;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\VehiclePerformance;

class FuelReportController extends Controller
{
    public function index(Request $request)
    {
        $vehicles = Vehicle::all();
        $fuels = Fuel::all();

        $query = FuelRequest::with(['vehicle', 'fuel']);

        if ($request->filled('vehicle_id')) {
            $query->where('vehicle_id', $request->vehicle_id);
        }

        if ($request->filled('fuel_id')) {
            $query->where('fuel_id', $request->fuel_id);
        }

        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('date', [
                Carbon::parse($request->from_date)->startOfDay(),
                Carbon::parse($request->to_date)->endOfDay()
            ]);
        }

        // Step 1: Raw grouped data
        $rawData = $query->select(
            DB::raw('vehicle_id, fuel_id, DATE_FORMAT(date, "%Y-%m-%d") as period'),
            DB::raw('SUM(amount) as total_fuel')
        )
        ->groupBy('vehicle_id', 'fuel_id', 'period')
        ->orderBy('period', 'desc')
        ->get();

        // Step 2: Fetch all prices (one query)
        $fuelPrices = FuelPrice::where('is_active', true)
            ->orderBy('date', 'desc')
            ->get()
            ->groupBy('fuel_id');

        // Step 3: Attach price and total cost
        foreach ($rawData as $row) {
            $price = optional(
                $fuelPrices[$row->fuel_id] ?? collect()
            )->firstWhere(fn ($price) => $price->date <= $row->period);

            $row->price = $price->price_in_ETB ?? 0;
            $row->total_price = $row->total_fuel * $row->price;
        }
         // Pagination manually
        $page = $request->get('page', 1);
        $perPage = 10;
        $pagedData = $rawData->slice(($page - 1) * $perPage, $perPage)->values();

        $data = new LengthAwarePaginator(
            $pagedData,
            $rawData->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

            if ($request->has('export') && $request->export === 'excel') {
                return Excel::download(new FuelReportExport($data), 'fuel_summary_report.xlsx');
            }

        return view('reports.fuel_summary', compact('data', 'vehicles', 'fuels'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        // Filters
        $query = FuelRequest::with(['vehicle', 'fuel']);
        //->where('status', 'approved');

        if ($request->filled('vehicle_id')) {
            $query->where('vehicle_id', $request->vehicle_id);
        }

        if ($request->filled('fuel_id')) {
            $query->where('fuel_id', $request->fuel_id);
        }

        if ($request->filled('from_date')) {
            $query->whereDate('date', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('date', '<=', $request->to_date);
        }

        $data = $query->get();

        // Group data for chart: [vehicle_name => [fuel_name => total_amount]]
        $grouped = [];

        foreach ($data as $entry) {
            $vehicleKey = $entry->vehicle->name . ' (' . $entry->vehicle->registration_number . ')';
            $fuelName = $entry->fuel->name;

            if (!isset($grouped[$vehicleKey])) {
                $grouped[$vehicleKey] = [];
            }

            if (!isset($grouped[$vehicleKey][$fuelName])) {
                $grouped[$vehicleKey][$fuelName] = 0;
            }

            $grouped[$vehicleKey][$fuelName] += $entry->amount;
        }

        // Build chart data
       $vehicles = array_keys($grouped);

        $fuelTypes = collect($grouped)
            ->flatMap(fn($fuels) => array_keys($fuels))
            ->unique()
            ->values();

        $datasets = [];

        foreach ($fuelTypes as $fuel) {
            $datasets[] = [
                'label' => $fuel,
                'data' => array_map(fn ($v) => $v[$fuel] ?? 0, $grouped),
                'backgroundColor' => '#' . substr(md5($fuel), 0, 6),
            ];
        }

        return view('reports.fuel_summary_chart', [
            'vehicles' => Vehicle::all(),
            'fuels' => Fuel::all(),
            'labels' => $vehicles,
            'datasets' => $datasets,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //


    }

    /**
     * Display the specified resource.
     */
    public function show(FuelReport $fuelReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FuelReport $fuelReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FuelReport $fuelReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FuelReport $fuelReport)
    {
        //
    }
    public function efficencyReport(Request $request)
    {
       $vehicles = Vehicle::all();

        $query = FuelRequest::with('vehicle');

        if ($request->filled('vehicle_id')) {
            $query->where('vehicle_id', $request->vehicle_id);
        }

        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('date', [
                Carbon::parse($request->from_date)->startOfDay(),
                Carbon::parse($request->to_date)->endOfDay()
            ]);
        }

        $fuelRequests = $query->get();

        $report = [];

        foreach ($fuelRequests->groupBy('vehicle_id') as $vehicleId => $records) {
            $vehicle = $records->first()->vehicle;

            $total_km = $records->sum('total_km_covered_by_vehicle');
            $total_fuel = $records->sum('amount');

            $actual_km_per_l = $total_fuel > 0 ? $total_km / $total_fuel : 0;

            // Get the latest vehicle performance record
            $performance = VehiclePerformance::where('vehicle_id', $vehicleId)
                            ->orderByDesc('date')
                            ->first();

            $expected_km_per_l = $performance?->average_km_per_litter ?? null;

            $report[] = [
                'vehicle' => $vehicle->name . ' (' . $vehicle->registration_number . ')',
                'expected_km_per_l' => $expected_km_per_l,
                'actual_km_per_l' => $actual_km_per_l,
                'variance' => $expected_km_per_l !== null ? $actual_km_per_l - $expected_km_per_l : null,
                'total_km' => $total_km,
                'total_fuel' => $total_fuel,
            ];
        }

        return view('reports.actual_vs_expected_fuel_efficiency', compact('report', 'vehicles'));
    }
}
