@extends('layouts.myapp')

@section('title', 'Create Station Fuel Record')

@section('content')
<main class="app-main">
    <div class="app-content">
        <div class="container-fluid">
            <div class="card mb-4">
                <div class="card-header">
                    <h3>Create New Station Fuel Record</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('station-fuel-storeds.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="station_id" class="form-label">Station <span class="text-danger">*</span></label>
                            <select name="station_id" class="form-control" required>
                                <option value="">Select Station</option>
                                @foreach($stations as $station)
                                    <option value="{{ $station->id }}" {{ old('station_id') == $station->id ? 'selected' : '' }}>
                                        {{ $station->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="fuel_id" class="form-label">Fuel <span class="text-danger">*</span></label>
                            <select name="fuel_id" class="form-control" required>
                                <option value="">Select Fuel</option>
                                @foreach($fuels as $fuel)
                                    <option value="{{ $fuel->id }}" {{ old('fuel_id') == $fuel->id ? 'selected' : '' }}>
                                        {{ $fuel->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="amount" class="form-control" value="{{ old('amount') }}" required>
                        </div>

                        {{-- <div class="mb-3">
                            <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                            <input type="date" name="date" class="form-control" value="{{ old('date') ?? date('Y-m-d') }}" required>
                        </div> --}}

                        {{-- <div class="mb-3">
                            <label for="received_by" class="form-label">Received By <span class="text-danger">*</span></label>
                            <input type="text" name="received_by" class="form-control" value="{{ old('received_by') }}" required>
                        </div> --}}

                        <div class="mb-3">
                            <label for="notes" class="form-label">Notes</label>
                            <textarea name="notes" class="form-control">{{ old('notes') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('station-fuel-storeds.index') }}" class="btn btn-secondary">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
