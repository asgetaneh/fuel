@extends('layouts.myapp')

@section('content')
    <div class="app-content-header"></div>
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row mb-3 align-items-center">
                <div class="col">
                    <h2>Fuel Request Reasons</h2>
                </div>
                <div class="col text-end">
                    <a href="{{ route('fuel-request-reasons.create') }}" class="btn btn-primary">Add New</a>
                </div>
            </div>

            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Trip</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($fuelRequestReasons as $reason)
                        <tr>
                            <td>{{ $reason->name }}</td>
                            <td>{{ $reason->description }}</td>
                            <td>{{ $reason->trip?->description ?? 'N/A' }}</td>
                            <td>
                                <a href="{{ route('fuel-request-reasons.show', $reason->id) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('fuel-request-reasons.edit', $reason->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('fuel-request-reasons.destroy', $reason->id) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
