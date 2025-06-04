@extends('layouts.myapp')

@section('title', 'Create Vehicle Performance')

@section('content')
<main class="app-main">
    <div class="app-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Create Vehicle Performance</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('vehicle-performances.store') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="vehicle_id" class="form-label">Vehicle</label>
                                    <select name="vehicle_id" class="form-control" required>
                                        <option value="">Select Vehicle</option>
                                        @foreach($vehicles as $vehicle)
                                            <option value="{{ $vehicle->id }}">{{ $vehicle->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Average Distance (km/hr)</label>
                                    <input type="number" step="0.01" name="average_distance_km_per_hr" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Average km/liter</label>
                                    <input type="number" step="0.01" name="average_km_per_litter" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Speed (km/hr)</label>
                                    <input type="number" step="0.01" name="speed_per_km_hr" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Date</label>
                                    <input type="date" name="date" class="form-control" required>
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Save
                                    </button>
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
