<!-- resources/views/trips/edit.blade.php -->
@extends('layouts.myapp')

@section('title', 'Edit Trip')

@section('content')
<main class="app-main">
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Trip</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('trips.update', $trip->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <input type="text" name="description" class="form-control" value="{{ $trip->description }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">From</label>
                                    <input type="text" name="from" class="form-control" value="{{ $trip->from }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">To</label>
                                    <input type="text" name="to" class="form-control" value="{{ $trip->to }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Vehicle</label>
                                    <select name="vehicle_id" class="form-control">
                                        @foreach($vehicles as $vehicle)
                                            <option value="{{ $vehicle->id }}" {{ $trip->vehicle_id == $vehicle->id ? 'selected' : '' }}>{{ $vehicle->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Start Time</label>
                                    <input type="datetime-local" name="start_time" class="form-control" value="{{ $trip->start_time->format('Y-m-d\TH:i') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">End Time</label>
                                    <input type="datetime-local" name="end_time" class="form-control" value="{{ $trip->end_time->format('Y-m-d\TH:i') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Driver</label>
                                    <select name="driver_id" class="form-control">
                                        @foreach($drivers as $driver)
                                            <option value="{{ $driver->id }}" {{ $trip->driver_id == $driver->id ? 'selected' : '' }}>{{ $driver->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('trips.index') }}" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
