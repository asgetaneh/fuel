@extends('layouts.myapp')

@section('title', 'Vehicle List')

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
                                    <h3 class="card-title">Vehicle List</h3>
                                </div>
                                <div class="col-sm-6 card-title text-end">
                                    <a href="{{ route('vehicles.create') }}" class="btn btn-primary">
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
                                        <th>Name</th>
                                        <th>Vehicle Type</th>
                                        <th>Registration #</th>
                                        <th>Engine #</th>
                                        <th>Total Seat</th>
                                        <th>Driver</th>
                                        <th>Active</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($vehicles as $vehicle)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $vehicle->name }}</td>
                                            <td>{{ $vehicle->vehicleType->name ?? '-' }}</td>
                                            <td>{{ $vehicle->registration_number }}</td>
                                            <td>{{ $vehicle->engine_number }}</td>
                                            <td>{{ $vehicle->total_seat }}</td>
                                            <td>{{ $vehicle->driver->name ?? 'N/A' }}</td>
                                            <td>
                                                @if($vehicle->is_active)
                                                    <span class="badge bg-success">Yes</span>
                                                @else
                                                    <span class="badge bg-danger">No</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('vehicles.show', $vehicle->id) }}" class="btn btn-sm btn-info" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center">No vehicles found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer d-flex justify-content-end">
                            {{ $vehicles->links() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>
@endsection
