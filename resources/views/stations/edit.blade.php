@extends('layouts.myapp')

@section('title', 'Edit Station')

@section('content')
<main class="app-main">
    <div class="container mt-4">
        <h3>Edit Station</h3>
        <form action="{{ route('stations.update', $station->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Station Name</label>
                <input type="text" class="form-control" name="name" value="{{ $station->name }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" rows="3">{{ $station->description }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Update
            </button>
            <a href="{{ route('stations.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</main>
@endsection
