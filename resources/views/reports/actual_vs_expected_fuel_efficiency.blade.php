@extends('layouts.myapp')

@section('title', 'Actual vs Expected Fuel Performance Report')

@section('content')
<main class="app-main pt-4">
    <div class="container-fluid">

        <!-- Filters -->
        <div class="card mb-3">
            <div class="card-header">
                <h3 class="card-title">⚖️ Actual vs Expected Fuel Efficiency</h3>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('fuel-reports.efficency') }}" class="row g-3">
                    <div class="col-md-4">
                        <label for="vehicle_id" class="form-label">Vehicle</label>
                        <select name="vehicle_id" id="vehicle_id" class="form-select">
                            <option value="">All Vehicles</option>
                            @foreach($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}" {{ request('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                                    {{ $vehicle->name }} ({{ $vehicle->registration_number }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="from_date" class="form-label">From Date</label>
                        <input type="date" id="from_date" name="from_date" class="form-control" value="{{ request('from_date') }}">
                    </div>

                    <div class="col-md-3">
                        <label for="to_date" class="form-label">To Date</label>
                        <input type="date" id="to_date" name="to_date" class="form-control" value="{{ request('to_date') }}">
                    </div>

                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Filter</button>
                    </div>
                </form>

                <div class="mt-3 text-end">
                    <a href="{{ route('fuel-report.export', request()->query()) }}" class="btn btn-success">⬇️ Export to Excel</a>
                </div>
            </div>
        </div>

        <!-- Report Table -->
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>Vehicle</th>
                            <th>Expected KM/L</th>
                            <th>Actual KM/L</th>
                            <th>Variance </th>
                            <th>KM Covered (After previous fetch) </th>
                            <th>Fuel Used (L)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($report as $row)
                            <tr>
                                <td>
                                    {{-- {{ \Carbon\Carbon::parse($row['date'])->format('Y-m-d') }} {{"-->"}}  --}}
                                    {{ $row['createdAt'] }}</td>
                                <td>{{ $row['vehicle'] }}</td>
                                <td>{{ $row['expected_km_per_l'] !== null ? number_format($row['expected_km_per_l'], 2) : 'N/A' }}</td>
                                <td>{{ $row['actual_km_per_l'] !== null ? number_format($row['actual_km_per_l'], 2) : 'N/A' }}</td>
                                <td class="{{ $row['variance'] > 0 ? 'text-success' : 'text-danger' }}">
                                    {{ $row['variance'] !== null ? number_format($row['variance'], 2) : 'N/A' }}
                                </td>
                                <td>{{ number_format($row['km_covered'], 2) }}</td>
                                <td>{{ $row['fuel_used'] !== null ? number_format($row['fuel_used'], 2) : 'N/A' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No data available for the selected filters.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
