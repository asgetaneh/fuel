@extends('layouts.myapp')

@section('title', 'Station Details')

@section('content')
<main class="app-main">
    <div class="container mt-4">
        <h3>Station Details</h3>

        <div class="card">
            <div class="card-body">
                <h5><strong>Name:</strong> {{ $station->name }}</h5>
                <p><strong>Description:</strong> {{ $station->description }}</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('stations.edit', $station->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="{{ route('stations.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
</main>
@endsection
