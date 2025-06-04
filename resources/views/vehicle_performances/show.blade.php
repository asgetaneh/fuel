@extends('layouts.myapp')

@section('title', 'Vehicle Performance Details')

@section('content')
<main class="app-main">
    <div class="app-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Performance Details</h3>
                        </div>
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-4">Vehicle</dt>
                                <dd class="col-sm-8">{{ $vehiclePerformance->vehicle->name ?? 'N/A' }}</dd>

                                <dt class="col-sm-4">Average Distance (km/hr)</dt>
                                <dd class="col-sm-8">{{ $vehiclePerformance->average_distance_km_per_hr }}</dd>

                                <dt class="col-sm-4">Average km/l</dt>
                                <dd class="col-sm-8">{{ $vehiclePerformance->average_km_per_litter }}</dd>

                                <dt class="col-sm-4">Speed (km/hr)</dt>
                                <dd class="col-sm-8">{{ $vehiclePerformance->speed_per_km_hr }}</dd>

                                <dt class="col-sm-4">Date</dt>
                                <dd class="col-sm-8">{{ $vehiclePerformance->date }}</dd>

                                <dt class="col-sm-4">Recorded By</dt>
                                <dd class="col-sm-8">{{ $vehiclePerformance->recordedBy->name ?? 'N/A' }}</dd>

                                <dt class="col-sm-4">Description</dt>
                                <dd class="col-sm-8">{{ $vehiclePerformance->description }}</dd>
                            </dl>
                            <div class="text-end">
                                <a href="{{ route('vehicle_performance.edit', $vehiclePerformance->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="{{ route('vehicle_performance.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Back
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
