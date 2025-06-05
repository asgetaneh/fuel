@extends('layouts.myapp')

@section('title', 'Create Fuel Request')

@section('content')
<main class="app-main">
    <div class="app-content">
        <div class="container-fluid">
            <div class="card mb-4">
                <div class="card-header">
                    <h3>Create New Fuel Request</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('fuel-requests.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="vehicle_id" class="form-label">Vehicle <span class="text-danger">*</span></label>
                            <select name="vehicle_id" class="form-control" required>
                                <option value="">Select Vehicle</option>
                                @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}">{{ $vehicle->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="total_km" class="form-label">Total KM Covered <span class="text-danger">*</span></label>
                            <input type="number" name="total_km_covered_by_vehicle" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="fuel_id" class="form-label">Fuel Type <span class="text-danger">*</span></label>
                            <select name="fuel_id" class="form-control" required>
                                <option value="">Select Fuel</option>
                                @foreach($fuels as $fuel)
                                    <option value="{{ $fuel->id }}">{{ $fuel->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount (Liters)</label>
                            <input type="number" step="0.01" name="amount" class="form-control">
                        </div>

                        {{-- <div class="mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}">
                        </div> --}}

                        <div class="mb-3">
                            <label for="station_id" class="form-label">Fuel Station</label>
                            <select name="station_id" class="form-control">
                                <option value="">Select Station</option>
                                @foreach($stations as $station)
                                    <option value="{{ $station->id }}">{{ $station->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="service_reason_id" class="form-label">Service Reason</label>
                            <select name="service_reason_id" class="form-control">
                                <option value="">Select Reason</option>
                                @foreach($reasons as $reason)
                                    <option value="{{ $reason->id }}">{{ $reason->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label">Notes</label>
                            <textarea name="notes" class="form-control">{{ old('notes') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('fuel-requests.index') }}" class="btn btn-secondary">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
