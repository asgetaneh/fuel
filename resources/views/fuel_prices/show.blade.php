<!-- show.blade.php -->
@extends('layouts.myapp')

@section('title', 'Fuel Price Details')

@section('content')
<main class="app-main">
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Fuel Price Details</h3>
                        </div>
                        <div class="card-body">
                            <p><strong>Fuel:</strong> {{ $fuelPrice->fuel->name }}</p>
                            <p><strong>Price in ETB:</strong> {{ $fuelPrice->price_in_ETB }}</p>
                            <p><strong>Date:</strong> {{ $fuelPrice->date }}</p>
                            <p><strong>Is Active:</strong> {{ $fuelPrice->is_active ? 'Yes' : 'No' }}</p>
                            <a href="{{ route('fuel-prices.index') }}" class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
