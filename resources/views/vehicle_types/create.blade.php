@extends('layouts.myapp')

@section('title', 'Add Vehicle Type')

@section('content')
<div class="container mt-4">
    <h3>Add Vehicle Type</h3>
    <form action="{{ route('vehicle-types.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>
        <button class="btn btn-success">Save</button>
        <a href="{{ route('vehicle-types.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
