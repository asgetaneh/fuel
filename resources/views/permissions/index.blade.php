@extends('layouts.myapp')

@section('title', 'Permissions')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between mb-3">
        <h4>Permissions List</h4>
        <a href="{{ route('permissions.create') }}" class="btn btn-primary">+ Add Permission</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr><th>#</th><th>Name</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @foreach($permissions as $index => $permission)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $permission->name }}</td>
                    <td>
                        <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
