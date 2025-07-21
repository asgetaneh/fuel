<!-- edit.blade.php -->
@extends('layouts.myapp')

@section('title', 'Edit Fuel Request')

@section('content')
<main class="app-main pt-5">
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Fuel Request</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('fuel-requests.update', $fuel_request) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="vehicle_id" class="form-label">Vehicle</label>
                                    <select name="vehicle_id" id="vehicle_id" class="form-control" required>
                                        @foreach($vehicles as $vehicle)
                                            <option value="{{ $vehicle->id }}" {{ $vehicle->id == $fuel_request->vehicle_id ? 'selected' : '' }}>
                                                {{ $vehicle->name }} ({{ $vehicle->plate_number }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="total_km_covered_by_vehicle" class="form-label">Total KM Covered</label>
                                    <input type="number" name="total_km_covered_by_vehicle" id="total_km_covered_by_vehicle"
                                           class="form-control" value="{{ $fuel_request->total_km_covered_by_vehicle }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="fuel_id" class="form-label">Fuel Type</label>
                                    <select name="fuel_id" id="fuel_id" class="form-control" required>
                                        @foreach($fuels as $fuel)
                                            <option value="{{ $fuel->id }}" {{ $fuel->id == $fuel_request->fuel_id ? 'selected' : '' }}>
                                                {{ $fuel->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="amount" class="form-label">Amount (ETB)</label>
                                    <input type="number" name="amount" id="amount" class="form-control"
                                           step="0.01" value="{{ $fuel_request->amount }}" required>
                                </div>

                                {{-- <div class="mb-3">
                                    <label for="station_id" class="form-label">Fuel Station</label>
                                    <select name="station_id" id="station_id" class="form-control" required>
                                        @foreach($stations as $station)
                                            <option value="{{ $station->id }}" {{ $station->id == $fuel_request->station_id ? 'selected' : '' }}>
                                                {{ $station->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div> --}}

                                <div class="mb-3">
                                    <label for="service_reason_id" class="form-label">Reason</label>
                                    <select name="service_reason_id" id="service_reason_id" class="form-control" required>
                                        @foreach($reasons as $reason)
                                            <option value="{{ $reason->id }}" {{ $reason->id == $fuel_request->service_reason_id ? 'selected' : '' }}>
                                                {{ $reason->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="notes" class="form-label">Notes</label>
                                    <textarea name="notes" id="notes" class="form-control" rows="3">{{ $fuel_request->notes }}</textarea>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-primary">Update Request</button>
                                    <a href="{{ route('fuel-requests.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
