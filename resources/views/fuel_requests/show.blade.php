<!-- show.blade.php -->
@extends('layouts.myapp')

@section('title', 'Fuel Request Details')

@section('content')
<main class="app-main pt-5">
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Fuel Request Details</h3>
                            <div class="card-options">
                                <a href="{{ route('fuel-requests.edit', $fuelRequest) }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th width="30%">Request ID</th>
                                            <td>{{ $fuelRequest->id }}</td>
                                        </tr>
                                        <tr>
                                            <th>Vehicle</th>
                                            <td>
                                                {{ $fuelRequest->vehicle->name ?? 'N/A' }}
                                                ({{ $fuelRequest->vehicle->plate_number ?? '' }})
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Total KM Covered</th>
                                            <td>{{ number_format($fuelRequest->total_km_covered_by_vehicle) }} km</td>
                                        </tr>
                                        <tr>
                                            <th>Fuel Type</th>
                                            <td>{{ $fuelRequest->fuel->name ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Amount</th>
                                            <td>{{ number_format($fuelRequest->amount, 2) }} ETB</td>
                                        </tr>
                                        <tr>
                                            <th>Fuel Station</th>
                                            <td>{{ $fuelRequest->station->name ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Request Reason</th>
                                            <td>{{ $fuelRequest->reason->name ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Request Date</th>
                                            <td>{{ $fuelRequest->date->format('M d, Y') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Requested By</th>
                                            <td>{{ $fuelRequest->requestedBy->name ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>
                                                <span class="badge bg-{{ $fuelRequest->statusColor() }}">
                                                    {{ ucfirst($fuelRequest->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Notes</th>
                                            <td>{{ $fuelRequest->notes ?? 'No notes available' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-4">
                                <a href="{{ route('fuel-requests.index') }}" class="btn btn-secondary">
                                    <i class="fa fa-arrow-left"></i> Back to List
                                </a>

                                @if($fuelRequest->isPending())
                                <form action="{{ route('fuel-requests.approve', $fuelRequest) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success ms-2">
                                        <i class="fa fa-check"></i> Approve
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
