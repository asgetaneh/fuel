<!-- resources/views/fuels/show.blade.php -->
@extends('layouts.myapp')

@section('title', 'Fuel Details')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Fuel Details</div>
                <div class="card-body">
                    <p><strong>Name:</strong> {{ $fuel->name }}</p>
                    <p><strong>Measurement:</strong> {{ $fuel->measurement->name ?? 'N/A' }}</p>
                    <a href="{{ route('fuels.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
