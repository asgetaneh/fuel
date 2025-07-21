<!-- show.blade.php -->
@extends('layouts.myapp')

@section('title', 'Fuel Price Details')

@section('content')
<main class="app-main pt-5">
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header" style="font-size: 20">
                            <h1 class="">Fuel Price Details</h1>
                        </div>
                        <div class="card-body">
                            <h2><b>{{ $fuelPrice->fuel->name }}</b>{{" ( in "}}{{ $fuelPrice->fuel->measurement->name ?? '-' }}{{")"}}</h2>
                            <h2><strong>Price in ETB:</strong> {{ $fuelPrice->price_in_ETB }}</h2>
                            <h2><strong>Date:</strong> {{ $fuelPrice->updated_at }}</h2>
                            <h2><strong>Is Active:</strong> {{ $fuelPrice->is_active ? 'Yes' : 'No' }}</h2>
                            <a href="{{ route('fuel-prices.index') }}" class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
