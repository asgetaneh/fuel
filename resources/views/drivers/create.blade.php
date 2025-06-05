@extends('layouts.myapp')

@section('title', 'Create Driver')

@section('content')
<main class="app-main">
    <div class="app-content">
        <div class="container-fluid">
            <div class="col-md-8 offset-md-2">
                <div class="card mt-4">
                    <div class="card-header"><h3 class="card-title">Create Driver</h3></div>
                    <div class="card-body">
                        <form action="{{ route('drivers.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>License Number</label>
                                <input type="text" name="license_number" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Phone</label>
                                <input type="text" name="phone" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="vehicle_type_id" class="form-label">Office</label>
                                <select name="vehicle_type_id" class="form-control" >
                                    <option value=" " disabled  >{{ "Select your offices" }}</option>
                                    @foreach ($offices as $office)
                                    <option value="{{ $office->id }}">{{ $office->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
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
