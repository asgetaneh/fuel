@extends('layouts.myapp')

@section('title', 'Create Permission')

@section('content')
<div class="container py-4">
    <h4>Create New Permission</h4>

    <form method="POST" action="{{ route('permissions.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Permission Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
        <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
