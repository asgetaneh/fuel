<!-- resources/views/trips/show.blade.php -->
@extends('layouts.myapp')

@section('title', 'Trip Details')

@section('content')
<main class="app-main">
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Trip Details</h3>
                        </div>
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-4">Description:</dt>
                                <dd class="col-sm-8">{{ $trip->description }}</dd>

                                <dt class="col-sm-4">From:</dt>
                                <dd class="col-sm-8">{{ $trip->from }}</dd>

                                <dt class="col-sm-4">To:</dt>
                                <dd class="col-sm-8">{{ $trip->to }}</dd>

                                <dt class="col-sm-4">Vehicle:</dt>
                                <dd class="col-sm-8">{{ $trip->vehicle->name ?? '-' }}</dd>

                                <dt class="col-sm-4">Driver:</dt>
                                <dd class="col-sm-8">{{ $trip->driver->name ?? '-' }}</dd>

                                <dt class="col-sm-4">Start Time:</dt>
                                <dd class="col-sm-8">{{ $trip->start_time }}</dd>

                                <dt class="col-sm-4">End Time:</dt>
                                <dd class="col-sm-8">{{ $trip->end_time }}</dd>
                            </dl>

                            <a href="{{ route('trips.index') }}" class="btn btn-secondary">Back</a>
                            <a href="{{ route('trips.edit', $trip->id) }}" class="btn btn-primary">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
