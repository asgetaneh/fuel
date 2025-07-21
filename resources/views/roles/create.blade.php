@extends('layouts.myapp')

@section('title', 'Create Role')

@section('content')
<div class="container py-4">
    <h4>Create New Role</h4>

    <form method="POST" action="{{ route('roles.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Role Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Assign Permissions</label><br>
            @foreach($permissions as $permission)
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" class="form-check-input" id="perm{{ $permission->id }}">
                    <label class="form-check-label" for="perm{{ $permission->id }}">{{ $permission->name }}</label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Create Role</button>
        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
