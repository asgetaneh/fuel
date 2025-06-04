@extends('layouts.myapp')

@section('title', 'Office Details')

@section('content')
<main class="app-main">
    <div class="app-content">
        <div class="container-fluid">
            <div class="col-md-8 offset-md-2">
                <div class="card mt-4">
                    <div class="card-header"><h3 class="card-title">Office Details</h3></div>
                    <div class="card-body">
                        <p><strong>Name:</strong> {{ $office->name }}</p>
                        <p><strong>Parent Office:</strong> {{ $office->parentOffice?->name ?? '-' }}</p>
                        <p><strong>Manager:</strong> {{ $office->manager?->name ?? '-' }}</p>
                        <p><strong>Description:</strong> {{ $office->description }}</p>
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{ route('offices.edit', $office->id) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('offices.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
