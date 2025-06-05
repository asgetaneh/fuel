<!-- resources/views/trips/index.blade.php -->
@extends('layouts.myapp')

@section('title', 'Trips')

@section('content')
<main class="app-main pt-5">
    <div class="app-content">
        <div class="container-fluid">
            <div class="card mb-4">
                 <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6"><h3 class="card-title">Trips List</h3></div>
                        <div class="col-sm-6 text-end">
                            <a href="{{ route('trips.create') }}" class="btn btn-primary float-right">
                                <i class="fas fa-plus-circle"></i> Create New
                            </a>
                        </div>
                    </div>
                 </div>
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Description</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Vehicle</th>
                                <th>Driver</th>
                                <th>Start</th>
                                <th>End</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($trips as $trip)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $trip->description }}</td>
                                    <td>{{ $trip->from }}</td>
                                    <td>{{ $trip->to }}</td>
                                    <td>{{ $trip->vehicle->name ?? '-' }}</td>
                                    <td>{{ $trip->driver->name ?? '-' }}</td>
                                    <td>{{ $trip->start_time }}</td>
                                    <td>{{ $trip->end_time }}</td>
                                    <td>
                                        <a href="{{ route('trips.show', $trip) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('trips.edit', $trip) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('trips.destroy', $trip) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $trips->links() }}
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
