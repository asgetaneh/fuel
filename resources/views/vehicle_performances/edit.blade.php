@extends('layouts.myapp')

@section('title', 'Edit Vehicle Performance')

@section('content')
<main class="app-main pt-5">
    <div class="app-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Edit Vehicle Performance</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('vehicle-performances.update', $vehiclePerformance->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="vehicle_id" class="form-label">Vehicle</label>
                                    <select name="vehicle_id" class="form-control" required>
                                        @foreach($vehicles as $vehicle)
                                            <option value="{{ $vehicle->id }}" {{ $vehiclePerformance->vehicle_id == $vehicle->id ? 'selected' : '' }}>
                                                {{ $vehicle->registration_number }} {{"("}}{{$vehicle->name ?? '-' }}{{")"}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Average Distance (km/hr)</label>
                                    <input type="number" step="0.01" name="average_distance_km_per_hr" class="form-control" value="{{ $vehiclePerformance->average_distance_km_per_hr }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Average km/liter</label>
                                    <input type="number" step="0.01" name="average_km_per_litter" class="form-control" value="{{ $vehiclePerformance->average_km_per_litter }}" required>
                                </div>

                                {{-- <div class="mb-3">
                                    <label class="form-label">Speed (km/hr)</label>
                                    <input type="number" step="0.01" name="speed_per_km_hr" class="form-control" value="{{ $vehiclePerformance->speed_per_km_hr }}" required>
                                </div> --}}

                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control">{{ $vehiclePerformance->description }}</textarea>
                                </div>

                                {{-- <div class="mb-3">
                                    <label class="form-label">Date</label>
                                    <input type="date" name="date" class="form-control" value="{{ $vehiclePerformance->date }}" required>
                                </div> --}}

                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Update
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
