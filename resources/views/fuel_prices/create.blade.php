<!-- create.blade.php -->
@extends('layouts.myapp')

@section('title', 'Create Fuel Price')

@section('content')
<main class="app-main">
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add New Fuel Price</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('fuel-prices.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="fuel_id" class="form-label">Fuel</label>
                                    <select name="fuel_id" id="fuel_id" class="form-control">
                                        @foreach($fuels as $fuel)
                                            <option value="{{ $fuel->id }}">{{ $fuel->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="price_in_ETB" class="form-label">Price (ETB)</label>
                                    <input type="number" name="price_in_ETB" id="price_in_ETB" class="form-control" step="0.01" required>
                                </div>

                                <div class="mb-3">
                                    <label for="date" class="form-label">Date</label>
                                    <input type="date" name="date" id="date" class="form-control" required>
                                </div>

                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active">
                                    <label class="form-check-label" for="is_active">Active</label>
                                </div>

                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{ route('fuel-prices.index') }}" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
