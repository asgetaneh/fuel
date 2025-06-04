@extends('layouts.myapp')

@section('title', 'Edit Driver')

@section('content')
<main class="app-main">
    <div class="app-content">
        <div class="container-fluid">
            <div class="col-md-8 offset-md-2">
                <div class="card mt-4">
                    <div class="card-header"><h3 class="card-title">Edit Driver</h3></div>
                    <div class="card-body">
                        <form action="{{ route('drivers.update', $driver->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label>Name</label>
                                <input type="text" name="name" value="{{ $driver->name }}" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>License Number</label>
                                <input type="text" name="license_number" value="{{ $driver->license_number }}" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Phone</label>
                                <input type="text" name="phone" value="{{ $driver->phone }}" class="form-control">
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
                                <a href="{{ route('drivers.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
