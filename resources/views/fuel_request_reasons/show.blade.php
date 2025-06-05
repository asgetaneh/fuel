@extends('layouts.myapp')

@section('content')
<div class="app-content-header"></div>
<div class="container">
    <div class="card">
        <div class="card-body">

            <div class="row mb-3 align-items-center">
                <div class="col">
                    <h2>Fuel Request Reason Details</h2>
                </div>
                <div class="col text-end">
                    <a href="{{ route('fuel-request-reasons.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>

            <div class="mb-3">
                <strong>Name:</strong>
                <p>{{ $fuelRequestReason->name }}</p>
            </div>

            <div class="mb-3">
                <strong>Description:</strong>
                <p>{{ $fuelRequestReason->description }}</p>
            </div>

            <div class="mb-3">
                <strong>Trip:</strong>
                <p>{{ $fuelRequestReason->trip?->description ?? 'N/A' }}</p>
            </div>

        </div>
    </div>
</div>
@endsection
