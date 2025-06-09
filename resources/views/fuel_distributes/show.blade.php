@extends('layouts.myapp')

@section('title', 'View Fuel Distribution')

@section('content')
<main class="app-main">
    <div class="app-content">
        <div class="container-fluid">
            <div class="card mb-4">
                <div class="card-header">
                    <h3>Fuel Distribution Details</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Vehicle:</strong> {{ $fuelDistribute->vehicle->name ?? '-' }}</li>
                        <li class="list-group-item"><strong>Amount:</strong> {{ $fuelDistribute->amount }} Liters</li>
                        <li class="list-group-item"><strong>Date:</strong> {{ $fuelDistribute->date }}</li>
                        <li class="list-group-item"><strong>Station:</strong> {{ $fuelDistribute->station->name ?? '-' }}</li>
                        <li class="list-group-item"><strong>Notes:</strong> {{ $fuelDistribute->notes ?? '-' }}</li>
                    </ul>
                    <a href="{{ route('fuel_distributes.index') }}" class="btn btn-secondary mt-3">Back</a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
