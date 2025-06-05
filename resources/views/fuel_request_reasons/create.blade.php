@extends('layouts.myapp')

@section('content')
<div class="app-content-header"></div>
<div class="container">
    <div class="card">
        <div class="card-body">

            <div class="row mb-3 align-items-center">
                <div class="col">
                    <h2>Add Fuel Request Reason</h2>
                </div>
                <div class="col text-end">
                    <a href="{{ route('fuel-request-reasons.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>

            <form action="{{ route('fuel-request-reasons.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>

                <div class="mb-3">
                    <label for="trip_id" class="form-label">Trip</label>
                    <select name="trip_id" class="form-control">
                        <option value="">-- Select Trip (optional) --</option>
                        @foreach($trips as $trip)
                            <option value="{{ $trip->id }}">{{ $trip->description }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>

        </div>
    </div>
</div>
@endsection
