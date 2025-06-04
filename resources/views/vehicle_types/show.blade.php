@extends('layouts.myapp')

@section('title', 'Vehicle Type Details')

@section('content')
<div class="container mt-4">
    <h3>Vehicle Type Details</h3>
    <div class="mb-3">
        <strong>Name:</strong> {{ $vehicleType->name }}
    </div>
    <div class="mb-3">
        <strong>Description:</strong> {{ $vehicleType->description }}
    </div>
    <a href="{{ route('vehicle-types.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
