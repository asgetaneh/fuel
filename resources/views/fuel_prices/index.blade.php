<!-- resources/views/fuel_prices/index.blade.php -->
@extends('layouts.myapp')

@section('title', 'Fuel Price List')

@section('content')
<main class="app-main pt-5">
    <div class="app-content-header"></div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between">
                            <h3 class="card-title">Fuel Price List</h3>
                            <a href="{{ route('fuel-prices.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus-circle"></i> Create New
                            </a>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Fuel</th>
                                        <th>Price (ETB)</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($fuelPrices as $fuelPrice)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $fuelPrice->fuel->name }}</td>
                                            <td>{{ $fuelPrice->price_in_ETB }}</td>
                                            <td>{{ $fuelPrice->date }}</td>
                                            <td>
                                                <span class="badge bg-{{ $fuelPrice->is_active ? 'success' : 'secondary' }}">
                                                    {{ $fuelPrice->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('fuel-prices.show', $fuelPrice->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                <a href="{{ route('fuel-prices.edit', $fuelPrice->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('fuel-prices.destroy', $fuelPrice->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="6" class="text-center">No fuel prices found.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            {{ $fuelPrices->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
