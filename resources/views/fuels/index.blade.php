<!-- resources/views/fuels/index.blade.php -->
@extends('layouts.myapp')

@section('title', 'Fuels List')

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
                                <div class="col-sm-6"><h3 class="card-title">Fuel List</h3></div>
                                <div class="col-sm-6 card-title text-end">
                                    <a href="{{ route('fuels.create') }}" class="btn btn-primary">
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
                                        <th>Measurement</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($fuels as $fuel)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $fuel->name }}</td>
                                            <td>{{ $fuel->measurement->name ?? 'N/A' }}</td>
                                            <td>
                                                <a href="{{ route('fuels.show', $fuel->id) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                                <a href="{{ route('fuels.edit', $fuel->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('fuels.destroy', $fuel->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="4" class="text-center">No fuels found.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            {{ $fuels->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
