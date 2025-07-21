@extends('layouts.myapp')

@section('content')
<main class="app-main">
    <div class="app-content-header"></div>
    <div class="app-content">
        <div class="container-fluid">
            <!-- Dashboard Summary Cards -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="mb-0">Dashboard</h3>
                                </div>
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-end">
                                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                                        <li class="breadcrumb-item active">Dashboard</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="row p-3">
                                @foreach ([
                                    ['label' => 'Total Service Distributed', 'count' => $totalRequests, 'icon' => 'fa-gas-pump', 'bg' => 'primary'],
                                    ['label' => 'Total Types of Services Distributed', 'count' => $TotalTypesofServicesDistrubited, 'icon' => 'fa-check-circle', 'bg' => 'success'],
                                    ['label' => 'Vehicles', 'count' => $vehicles, 'icon' => 'fa-car', 'bg' => 'info'],
                                    ['label' => 'Total Vehicle By Types', 'count' => $vehicle_types, 'icon' => 'fa-hourglass-half', 'bg' => 'warning'],
                                    ['label' => 'Users', 'count' => $users, 'icon' => 'fa-users', 'bg' => 'dark'],
                                    ['label' => 'Fuel Types', 'count' => $fuels, 'icon' => 'fa-oil-can', 'bg' => 'secondary']
                                ] as $card)
                                <div class="col-md-4 mb-3">
                                    <div class="card text-white bg-{{ $card['bg'] }}">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <i class="fas {{ $card['icon'] }} fa-2x me-3"></i>
                                                <div>
                                                    <h5 class="card-title">{{ $card['label'] }}</h5>
                                                    <h3>{{ $card['count'] }}</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <!-- Fuel Type Request Chart -->
                            <div class="card mt-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4>Total Requested Fuel Type</h4>
                                    <select id="fuelTypeFilter" class="form-select w-auto">
                                        <option value="month" {{ $filter == 'month' ? 'selected' : '' }}>Monthly</option>
                                        <option value="quarter" {{ $filter == 'quarter' ? 'selected' : '' }}>Quarterly</option>
                                        <option value="semi" {{ $filter == 'semi' ? 'selected' : '' }}>Semi-Annual</option>
                                        <option value="year" {{ $filter == 'year' ? 'selected' : '' }}>Annual</option>
                                    </select>
                                </div>
                                <div class="card-body">
                                    <canvas id="fuelTypeChart" ></canvas>
                                </div>
                            </div>

                            <!-- Vehicle Fuel Usage Chart -->
                            <div class="card mt-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4>Vehicle Fuel Usage</h4>
                                </div>
                                <div class="card-body">
                                    <canvas id="vehicleUsageChart"></canvas>
                                </div>
                            </div>

                            <!-- Vehicle Fuel Usage Performance Comparison -->
                            <div class="card mt-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4>Vehicle Performance Comparison</h4>
                                </div>
                                <div class="card-body">
                                    <canvas id="performanceChart"></canvas>
                                </div>
                            </div>

                        </div> <!-- card-body -->
                    </div> <!-- card -->
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Wait for DOM to be fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Debugging - check if elements exist
        console.log('Canvas elements:');
        console.log('fuelTypeChart:', document.getElementById('fuelTypeChart'));
        console.log('vehicleUsageChart:', document.getElementById('vehicleUsageChart'));
        console.log('performanceChart:', document.getElementById('performanceChart'));

        // Ensure elements exist before creating charts
        function createChartIfExists(id, config) {
            const ctx = document.getElementById(id);
            if (ctx) {
                new Chart(ctx, config);
            } else {
                console.error('Canvas element not found:', id);
            }
        }

        // Fuel Type Chart
        createChartIfExists('fuelTypeChart', {
            type: 'bar',
            data: {
                labels: @json($fuelTypeData->map(fn($f) => $f->fuel ? $f->fuel->name : 'Unknown')),
                datasets: [{
                    label: 'Fuel Requests (L)',
                    data: @json($fuelTypeData->map(fn($f) => $f->total ?? 0)),
                    backgroundColor: 'rgba(54, 162, 235, 0.7)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Vehicle Usage Chart
        createChartIfExists('vehicleUsageChart', {
            type: 'line',
            data: {
                labels: @json($vehicleFuelUsage->map(fn($v) => $v->vehicle ? $v->vehicle->name : 'Unknown')),
                datasets: [{
                    label: 'Usage (L)',
                    data: @json($vehicleFuelUsage->map(fn($v) => $v->total ?? 0)),
                    fill: false,
                    borderColor: 'rgba(255, 99, 132, 0.8)',
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Performance Chart
        createChartIfExists('performanceChart', {
            type: 'radar',
            data: {
                labels: @json($performanceData->pluck('vehicle')),
                datasets: [
                    {
                        label: 'Total Usage (Current)',
                        data: @json($performanceData->pluck('total')),
                        fill: true,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                    },
                    {
                        label: 'Average Usage',
                        data: @json($performanceData->pluck('average')),
                        fill: true,
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Filter change handler
        document.getElementById('fuelTypeFilter')?.addEventListener('change', function() {
            window.location.href = `?filter=${this.value}`;
        });
    });
</script>
@endsection
