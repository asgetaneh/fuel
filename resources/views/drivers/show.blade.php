@extends('layouts.myapp')

@section('title', 'Driver Details')

@section('content')
<main class="app-main">
    <div class="app-content">
        <div class="container-fluid">
            <div class="col-md-8 offset-md-2">
                <div class="card mt-4">
                    <div class="card-header"><h3 class="card-title">Driver Details</h3></div>
                    <div class="card-body">
                        <p><strong>Name:</strong> {{ $driver->name }}</p>
                        <p><strong>License Number:</strong> {{ $driver->license_number }}</p>
                        <p><strong>Phone:</strong> {{ $driver->phone }}</p>
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{ route('drivers.edit', $driver->id) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('drivers.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
