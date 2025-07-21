@extends('layouts.myapp')

@section('title', 'Offices Page')

@section('content')
<main class="app-main pt-5">
    <div class="app-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-6"><h3 class="card-title">Office List</h3></div>
                                <div class="col-sm-6 text-end">
                                    <a href="{{ route('offices.create') }}" class="btn btn-primary">
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
                                        <th>Description</th>
                                        <th>Parent Office</th>
                                        <th>Manager</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($offices as $office)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $office->name }}</td>
                                            <td>{{ $office->description ?? '-' }}</td>
                                            <td>{{ $office->parentOffice?->name ?? '-' }}</td>
                                            <td>{{ $office->manager?->name ?? '-' }}</td>
                                            <td>
                                                <a href="{{ route('offices.show', $office->id) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                                <a href="{{ route('offices.edit', $office->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('offices.destroy', $office->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="5" class="text-center">No offices found.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer d-flex justify-content-end">
                            {{ $offices->links() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>
@endsection
