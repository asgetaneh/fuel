@extends('layouts.myapp')

@section('title', 'Edit Vehicle Type')

@section('content')
<div class="container mt-4">
    <h3>Edit Vehicle Type</h3>
    <form action="{{ route('vehicle-types.update', $vehicleType->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $vehicleType->name }}" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="3">{{ $vehicleType->description }}</textarea>
        </div>
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('vehicle-types.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
