@extends('layouts.myapp')

@section('title', 'Fuel Consumption Report')

@section('content')
<!--begin::App Main-->
<main class="app-main pt-5">

    <!--begin::App Content-->
    <div class="app-content">
        <div class="container-fluid">

            <!-- Filter Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Filter Report</h3>
                </div>
                <div class="card-body">
                    <form method="GET" class="row g-3">
                        <div class="col-md-3">
                            <label for="vehicle_id" class="form-label">Vehicle</label>
                            <select name="vehicle_id" class="form-select">
                                <option value="">-- All Vehicles --</option>
                                @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}" {{ request('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                                        {{ $vehicle->name }} ({{ $vehicle->registration_number }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="fuel_id" class="form-label">Fuel Type</label>
                            <select name="fuel_id" class="form-select">
                                <option value="">-- All Fuel Types --</option>
                                @foreach($fuels as $fuel)
                                    <option value="{{ $fuel->id }}" {{ request('fuel_id') == $fuel->id ? 'selected' : '' }}>
                                        {{ $fuel->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="from_date" class="form-label">From Date</label>
                            <input type="date" name="from_date" class="form-control" value="{{ request('from_date') }}">
                        </div>

                        <div class="col-md-3">
                            <label for="to_date" class="form-label">To Date</label>
                            <input type="date" name="to_date" class="form-control" value="{{ request('to_date') }}">
                        </div>

                        <div class="col-md-12 d-flex justify-content-end mt-2">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i> Filter</button>
                            <a href="{{ route('fuel-reports.index', array_merge(request()->all(), ['export' => 'excel'])) }}"
                                class="btn btn-success ms-2">
                                <i class="fas fa-file-excel"></i> Export Excel
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Report Card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Fuel Consumption Summary</h3>
                </div>

                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Period</th>
                                <th>Vehicle</th>
                                <th>Fuel Type</th>
                                <th>Total Fuel (Liters)</th>
                                <th>Price / Liter (ETB)</th>
                                <th>Total Price (ETB)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $grandTotal = 0;
                                $grandETB = 0;
                            @endphp
                            @forelse($data as $index => $row)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $row->period }}</td>
                                    <td>{{ $row->vehicle->name ?? 'N/A' }} ({{ $row->vehicle->registration_number ?? 'N/A' }})</td>
                                    <td>{{ $row->fuel->name ?? 'N/A' }}</td>
                                    <td>{{ number_format($row->total_fuel, 2) }}</td>
                                    <td>{{ number_format($row->price, 2) }}</td>
                                    <td>{{ number_format($row->total_price, 2) }}</td>
                                </tr>
                                @php
                                    $grandTotal += $row->total_fuel;
                                    $grandETB += $row->total_price;
                                @endphp
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No records found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                        @if($grandTotal > 0)
                            <tfoot>
                                <tr class="fw-bold text-end">
                                    <td colspan="4">Grand Total (Liters):</td>
                                    <td>{{ number_format($grandTotal, 2) }}</td>
                                    <td></td>
                                    <td>{{ number_format($grandETB, 2) }}</td>
                                </tr>
                            </tfoot>
                        @endif
                    </table>
                </div>
                <div class="mt-3">
                    {{ $data->links() }}
                </div>
            </div>

        </div>
    </div>
    <!--end::App Content-->

</main>
<!--end::App Main-->
@endsection
