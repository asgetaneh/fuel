@extends('layouts.myapp')

@section('title', 'Station Fuel Record Details')

@section('content')
<main class="app-main">
    <div class="app-content">
        <div class="container-fluid">
            <div class="card mb-4">
                <div class="card-header">
                    <h3>Station Fuel Record Details</h3>
                </div>
                <div class="card-body">

                    <div class="mb-3">
                        <strong>Station:</strong> {{ $stationFuelStored->station->name ?? 'N/A' }}
                    </div>

                    <div class="mb-3">
                        <strong>Fuel:</strong> {{ $stationFuelStored->fuel->name ?? 'N/A' }}
                    </div>

                    <div class="mb-3">
                        <strong>Amount:</strong> {{ $stationFuelStored->amount }}
                    </div>

                    <div class="mb-3">
                        <strong>Date:</strong> {{ $stationFuelStored->date }}
                    </div>

                    <div class="mb-3">
                        <strong>Received By:</strong> {{ $stationFuelStored->received_by }}
                    </div>

                    <div class="mb-3">
                        <strong>Notes:</strong> {{ $stationFuelStored->notes }}
                    </div>

                    <a href="{{ route('station-fuel-storeds.index') }}" class="btn btn-secondary">Back</a>
                    <a href="{{ route('station-fuel-storeds.edit', $stationFuelStored->id) }}" class="btn btn-warning">Edit</a>

                </div>
            </div>
        </div>
    </div>
</main>
@endsection
