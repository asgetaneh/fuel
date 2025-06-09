@extends('layouts.myapp')

@section('title', 'Create Fuel Distribution')

@section('content')
<main class="app-main pt-5">
    <div class="app-content">
        <div class="container-fluid">
            <div class="card mb-4">
                <div class="card-header">
                    <h3>Create Fuel Distribution</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('fuel-distributes.store') }}" method="POST">
                        @csrf

                        <!-- Distribution Type -->
                        <div class="mb-3">
                            <label for="distribution_type" class="form-label">Distribution Type</label>
                            <select name="distribution_type" class="form-control" id="distribution_type" required>
                                <option value="">Select Type</option>
                                <option value="1">With Already Requested</option>
                                <option value="2">New Direct Request & Distribution</option>
                            </select>
                        </div>

                        <!-- With Request Section -->
                        <div  id="withrequest" style="display: none;">
                            <div class="mb-3">
                                <label for="fuel_request_id" class="form-label">Fuel Request</label>
                                <select name="fuel_request_id" class="form-control">
                                    <option value="">Select Request</option>
                                    @foreach($fuelRequests as $req)
                                        <option value="{{ $req->id }}">{{ $req->id }} - {{ $req->vehicle->name ?? '-' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Direct Distribution Section -->
                        <div id="directDistribution" style="display: none;">
                            <div class="mb-3">
                                <label for="vehicle_id" class="form-label">Vehicle</label>
                                <select name="vehicle_id" class="form-control" id="vehicle_id">
                                    <option value="">Select Vehicle</option>
                                    @foreach($vehicles as $vehicle)
                                        <option value="{{ $vehicle->id }}">{{ $vehicle->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="total_km" class="form-label">Total KM Covered <span class="text-danger">*</span></label>
                                <input type="number" name="total_km_covered_by_vehicle" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="fuel_id" class="form-label">Fuel Type <span class="text-danger">*</span></label>
                                <select name="fuel_id" class="form-control" required>
                                    <option value="">Select Fuel</option>
                                    @foreach($fuels as $fuel)
                                        <option value="{{ $fuel->id }}">{{ $fuel->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="station_id" class="form-label">Station</label>
                                <select name="station_id" class="form-control" id="station_id">
                                    <option value="">Select Station</option>
                                    @foreach($stations as $station)
                                        <option value="{{ $station->id }}">{{ $station->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="service_reason_id" class="form-label"> Reason</label>
                                <select name="service_reason_id" class="form-control">
                                    <option value="">Select Reason</option>
                                    @foreach($reasons as $reason)
                                        <option value="{{ $reason->id }}">{{ $reason->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Notes (Always shown) -->
                            <div class="mb-3" >
                                <label for="amount" class="form-label">Amount (L)</label>
                                <input type="number" step="0.01" name="amount" class="form-control" id="amount" value="{{ old('amount') }}">
                            </div>
                        <div class="mb-3">
                            <label for="notes" class="form-label">Notes</label>
                            <textarea name="notes" class="form-control">{{ old('notes') }}</textarea>
                        </div>

                        <!-- Hidden metadata -->
                        <input type="hidden" name="request_date" value="{{ \Carbon\Carbon::now()->toDateString() }}">
                        <input type="hidden" name="requested_by" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="approved_by" value="{{ auth()->user()->id }}">

                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('fuel-distributes.index') }}" class="btn btn-secondary">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
         $('#distribution_type').on('change', function () {
            const selected = $(this).val();
            if (selected === '1') {
                $('#withrequest').show();
                $('#directDistribution').hide();

                // Clear and disable direct fields
                $('#directDistribution').find('input, select').val('').prop('disabled', true);
                $('#withrequest').find('select').prop('disabled', false);
            } else if (selected === '2') {
                $('#withrequest').hide();
                $('#directDistribution').show();

                // Clear and disable with-request
                $('#withrequest').find('select').val('').prop('disabled', true);
                $('#directDistribution').find('input, select').prop('disabled', false);
            } else {
                $('#withrequest, #directDistribution').hide();
                $('#withrequest, #directDistribution').find('input, select').prop('disabled', true);
            }
        });
        // function toggleFormSections() {
        //     const selected = $('#distribution_type').val();
        //     console
            // if (selected === '1') {
            //     $('#withrequest').show();
            //     $('#directDistribution').hide();

            //     // Clear and disable direct fields
            //     $('#directDistribution').find('input, select').val('').prop('disabled', true);
            //     $('#withrequest').find('select').prop('disabled', false);
            // } else if (selected === '2') {
            //     $('#withrequest').hide();
            //     $('#directDistribution').show();

            //     // Clear and disable with-request
            //     $('#withrequest').find('select').val('').prop('disabled', true);
            //     $('#directDistribution').find('input, select').prop('disabled', false);
            // } else {
            //     $('#withrequest, #directDistribution').hide();
            //     $('#withrequest, #directDistribution').find('input, select').prop('disabled', true);
            // }
        // }

        // $('#distribution_type').on('change', toggleFormSections);
        // toggleFormSections(); // Run on load
    });
</script>
@endpush



{{-- <!DOCTYPE html>
<html>
<head>
    <title>Test</title>
</head>
<body>
    <select id="distribution_type">
      <option value="">Select</option>
      <option value="1">With Request</option>
      <option value="2">Direct</option>
    </select>
    <div id="output">Waiting...</div>

    <script>
    $(document).ready(function () {
        $('#distribution_type').on('change', function () {
            const val = $(this).val();
            $('#output').text('Selected: ' + val);
        });
    });
    </script>
</body>
</html> --}}
