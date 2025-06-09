@extends('layouts.myapp')

@section('title', 'Fuel Distributions')

@section('content')
<main class="app-main pt-5">
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="card-title">Fuel Distribution List</h3>
                                </div>
                                <div class="col-sm-6 card-title text-end">
                                    <a href="{{ route('fuel-distributes.create') }}" class="btn btn-primary">
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
                                        <th>Fuel Amount</th>
                                        <th>Date</th>
                                        <th>Station</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($fuelDistributes as $distribution)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $distribution->vehicle->name ?? '-' }}</td>
                                            <td>{{ $distribution->amount }} L</td>
                                            <td>{{ $distribution->date }}</td>
                                            <td>{{ $distribution->station->name ?? '-' }}</td>
                                            <td>
                                                <a href="{{ route('fuel-distributes.show', $distribution->id) }}" class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('fuel-distributes.edit', $distribution->id) }}" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('fuel-distributes.destroy', $distribution->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No distributions found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer d-flex justify-content-end">
                            {{ $fuelDistributes->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
