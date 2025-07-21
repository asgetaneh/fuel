@extends('layouts.myapp')

@section('title', 'Create Vehicle')

@section('content')
<main class="app-main pt-5">
  <div class="app-content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-10">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h3 class="card-title">Add New Vehicle</h3>
              <a href="{{ route('vehicles.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Back
              </a>
            </div>
            <div class="card-body">
              <form action="{{ route('vehicles.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                  <label for="name" class="form-label">Vehicle Name</label>
                  <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                  <label for="vehicle_type_id" class="form-label">Vehicle Type</label>
                  <select name="vehicle_type_id" class="form-control" required>
                    @foreach ($vehicleTypes as $type)
                      <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="mb-3">
                  <label for="registration_number" class="form-label">Plate(side) Number</label>
                  <input type="text" name="registration_number" class="form-control">
                </div>

                {{-- <div class="mb-3">
                  <label for="engine_number" class="form-label">Engine Number</label>
                  <input type="text" name="engine_number" class="form-control">
                </div> --}}

                <div class="mb-3">
                  <label for="total_seat" class="form-label">Total Seats</label>
                  <input type="number" name="total_seat" class="form-control">
                </div>

                <div class="mb-3">
                  <label for="driver_id" class="form-label">Driver</label>
                  <select name="driver_id" class="form-control">
                    <option value="">-- None --</option>
                    @foreach ($drivers as $driver)
                      <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="mb-3">
                  <label for="description" class="form-label">Description</label>
                  <textarea name="description" class="form-control" rows="3"></textarea>
                </div>

                <div class="mb-3 form-check">
                  <input type="checkbox" class="form-check-input" name="is_active" checked>
                  <label class="form-check-label">Active</label>
                </div>

                <button type="submit" class="btn btn-primary">
                  <i class="fas fa-save"></i> Save
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection
