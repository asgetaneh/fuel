@extends('layouts.myapp')

@section('title', 'Vehicle Performance')

@section('content')
<main class="app-main">
    <div class="app-content-header"></div>
    <div class="app-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="card-title">Vehicle Performance List</h3>
                                </div>
                                <div class="col-sm-6 card-title text-end">
                                    <a href="{{ route('vehicle-performances.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus-circle"></i> Create New
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Vehicle</th>
                                        <th>Avg Distance (km/hr)</th>
                                        <th>Avg Fuel (km/l)</th>
                                        <th>Speed (km/hr)</th>
                                        <th>Created By</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($performances as $performance)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $performance->vehicle->name }}</td>
                                            <td>{{ $performance->average_distance_km_per_hr }}</td>
                                            <td>{{ $performance->average_km_per_litter }}</td>
                                            <td>{{ $performance->speed_per_km_hr }}</td>
                                            <td>{{ $performance->recorder?->name }}</td>
                                            <td>{{ $performance->date }}</td>
                                            <td>
                                                <a href="{{ route('vehicle-performances.show', $performance->id) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                                <a href="{{ route('vehicle-performances.edit', $performance->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('vehicle-performances.destroy', $performance->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No performance records found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            {{ $performances->links() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>
@endsection
