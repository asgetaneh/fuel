@extends('layouts.myapp')

@section('title', 'Vehicle Detail')

@section('content')
<main class="app-main pt-5">
  <div class="app-content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h3 class="card-title">Vehicle Detail</h3>
          <a href="{{ route('vehicles.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Back
          </a>
        </div>
        <div class="card-body">
          <table class="table table-bordered">
            <tr><th>Name</th><td>{{ $vehicle->name }}</td></tr>
            <tr><th>Type</th><td>{{ $vehicle->vehicleType->name ?? 'N/A' }}</td></tr>
            <tr><th>Registration Number</th><td>{{ $vehicle->registration_number }}</td></tr>
            <tr><th>Engine Number</th><td>{{ $vehicle->engine_number }}</td></tr>
            <tr><th>Total Seats</th><td>{{ $vehicle->total_seat }}</td></tr>
            <tr><th>Driver</th><td>{{ $vehicle->driver->name ?? 'Unassigned' }}</td></tr>
            <tr><th>Description</th><td>{{ $vehicle->description }}</td></tr>
            <tr><th>Status</th><td>{!! $vehicle->is_active ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-secondary">Inactive</span>' !!}</td></tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection
