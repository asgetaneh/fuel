@extends('layouts.myapp')

@section('title', 'View Measurement')

@section('content')
<main class="app-main">
    <div class="app-content">
        <div class="container-fluid">
            <div class="card mb-4">
                <div class="card-header">
                    <h3>Measurement Details</h3>
                </div>
                <div class="card-body">
                    <p><strong>Name:</strong> {{ $measurement->name }}</p>
                    <p><strong>Description:</strong> {{ $measurement->description }}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('measurements.edit', $measurement->id) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ route('measurements.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
