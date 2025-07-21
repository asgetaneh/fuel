@extends('layouts.myapp')

@section('title', 'Fuel Consumption Report')

@section('content')
<!--begin::App Main-->
<main class="app-main pt-5">

    <!--begin::App Content-->
    <div class="app-content">
        <div class="container-fluid">

            <!-- Filter Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Filter Report</h3>
                </div>
                <div class="card-body">
                    <form method="GET" class="row g-3">
                        <div class="col-md-3">
                            <label for="vehicle_id" class="form-label">Vehicle</label>
                            <select name="vehicle_id" class="form-select">
                                <option value="">-- All Vehicles --</option>
                                @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}" {{ request('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                                        {{ $vehicle->name }} ({{ $vehicle->registration_number }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="fuel_id" class="form-label">Fuel Type</label>
                            <select name="fuel_id" class="form-select">
                                <option value="">-- All Fuel Types --</option>
                                @foreach($fuels as $fuel)
                                    <option value="{{ $fuel->id }}" {{ request('fuel_id') == $fuel->id ? 'selected' : '' }}>
                                        {{ $fuel->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="from_date" class="form-label">From Date</label>
                            <input type="date" name="from_date" class="form-control" value="{{ request('from_date') }}">
                        </div>

                        <div class="col-md-3">
                            <label for="to_date" class="form-label">To Date</label>
                            <input type="date" name="to_date" class="form-control" value="{{ request('to_date') }}">
                        </div>

                        <div class="col-md-12 d-flex justify-content-end mt-2">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i> Filter</button>
                            <a href="{{ route('fuel-reports.index', array_merge(request()->all(), ['export' => 'excel'])) }}"
                                class="btn btn-success ms-2">
                                <i class="fas fa-file-excel"></i> Export Excel
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Chart Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Fuel Consumption Chart</h3>
                </div>
                <div class="card-body">
                   <canvas id="fuelSummaryChart" height="100"></canvas>
                </div>
            </div>

        </div>
    </div>
    <!--end::App Content-->

</main>
<!--end::App Main-->


@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('fuelSummaryChart')?.getContext('2d');
    if (!ctx) return console.error("Canvas not found.");

    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($labels),  // Vehicle names
            datasets: @json($datasets), // Fuel grouped
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Fuel Consumption per Vehicle by Fuel Type'
                },
                legend: {
                    position: 'top'
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Vehicles'
                    },
                    ticks: {
                        autoSkip: false,
                        maxRotation: 45,
                        minRotation: 30
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Total Fuel (Liters)'
                    }
                }
            }
        }
    });
});
</script>
@endpush

