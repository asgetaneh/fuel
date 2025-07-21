@extends('layouts.myapp')

@section('title', 'Actual vs Expected Fuel Performance Report')

@section('content')
<main class="app-main pt-4">
    <div class="container-fluid">

        <!-- Report Title -->
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">⚖️ Actual vs Expected Fuel Efficiency</h3>
            </div>
        </div>

        <!-- Report Table -->
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>Vehicle</th>
                            <th>Expected KM/L</th>
                            <th>Actual KM/L</th>
                            <th>Variance</th>
                            <th>Total KM</th>
                            <th>Total Fuel Used (L)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($report as $row)
                            <tr>
                                <td>{{ $row['vehicle'] }}</td>
                                <td>{{ $row['expected_km_per_l'] !== null ? number_format($row['expected_km_per_l'], 2) : 'N/A' }}</td>
                                <td>{{ number_format($row['actual_km_per_l'], 2) }}</td>
                                <td class="{{ $row['variance'] > 0 ? 'text-success' : 'text-danger' }}">
                                    {{ $row['variance'] !== null ? number_format($row['variance'], 2) : 'N/A' }}
                                </td>
                                <td>{{ number_format($row['total_km'], 2) }}</td>
                                <td>{{ number_format($row['total_fuel'], 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No data available for the selected period.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</main>
@endsection
