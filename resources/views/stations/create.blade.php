@extends('layouts.myapp')

@section('title', 'Create Station')

@section('content')
<main class="app-main pt-5">
    <div class="container mt-4">
        <h4>Create New Station</h4>
        <form action="{{ route('stations.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Station Name</label>
                <input type="text" class="form-control" name="name" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description (optional)</label>
                <textarea class="form-control" name="description" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Save
            </button>
            <a href="{{ route('stations.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</main>
@endsection
