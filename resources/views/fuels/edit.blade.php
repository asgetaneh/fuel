<!-- resources/views/fuels/edit.blade.php -->
@extends('layouts.myapp')

@section('title', 'Edit Fuel')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Edit Fuel</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('fuels.update', $fuel->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $fuel->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="measurement_id" class="form-label">Measurement</label>
                            <select name="measurement_id" class="form-select" required>
                                <option value="">Select</option>
                                @foreach($measurements as $measurement)
                                    <option value="{{ $measurement->id }}" {{ $fuel->measurement_id == $measurement->id ? 'selected' : '' }}>{{ $measurement->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('fuels.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
