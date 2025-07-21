@extends('layouts.myapp')

@section('title', 'Create Fuel Request')

@section('content')
<main class="app-main pt-5">
    <div class="app-content">
        <div class="container-fluid">
            <div class="card mb-4">
                <div class="card-header">
                    <h3>Add New Fuel Distrubition</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('fuel-requests.store') }}" method="POST">
                        @csrf

                          <div class="mb-3">
                            <label for="vehicle_id" class="form-label">Vehicle Type<span class="text-danger">*</span></label>
                            <select id="vehicle_type_select" name="vehicle_type_id" class="form-control" required>
                                <option value="">Select Vehicle Type</option>
                                @foreach($vehicletypes as $vehicletype)
                                    <option value="{{ $vehicletype->id }}">{{ $vehicletype->name ?? '-' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="vehicle_id" class="form-label">Vehicle <span class="text-danger">*</span></label>
                            <select id="vehicle_select" name="vehicle_id" class="form-control" required>
                                <option value="">Select Vehicle</option>
                                {{-- Options will be dynamically populated --}}
                            </select>
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

                        <div class="mb-3" id="km_input_group" style="display:none;">
                            <label for="total_km" class="form-label">Total KM Covered <span class="text-danger">*</span></label>
                            <input type="number" name="total_km_covered_by_vehicle" class="form-control" id="total_km_input">
                        </div>



                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount (Liters)</label>
                            <input type="number" step="0.01" name="amount" class="form-control">
                        </div>

                        {{-- <div class="mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}">
                        </div> --}}

                        {{-- <div class="mb-3">
                            <label for="station_id" class="form-label">Fuel Station</label>
                            <select name="station_id" class="form-control">
                                <option value="">Select Station</option>
                                @foreach($stations as $station)
                                    <option value="{{ $station->id }}">{{ $station->name }}</option>
                                @endforeach
                            </select>
                        </div> --}}

                        <div class="mb-3">
                            <label for="service_reason_id" class="form-label">  Reason</label>
                            <select name="service_reason_id" class="form-control">
                                <option value="">Select Reason</option>
                                @foreach($reasons as $reason)
                                    <option value="{{ $reason->id }}">{{ $reason->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3" id="notes_group" style="display:none;">
                            <label id="notes_label" for="notes" class="form-label">description where to go or Why</label>
                            <textarea name="notes" class="form-control" id="notes_textarea">{{ old('notes') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('fuel-requests.index') }}" class="btn btn-secondary">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const vehicleTypeSelect = document.getElementById('vehicle_type_select');
    const vehicleSelect = document.getElementById('vehicle_select');

    const fuelSelect = document.querySelector('select[name="fuel_id"]');
    const reasonSelect = document.querySelector('select[name="service_reason_id"]');

    const kmGroup = document.getElementById('km_input_group');
    const kmInput = document.getElementById('total_km_input');

    const notesGroup = document.getElementById('notes_group');
    const notesTextarea = document.getElementById('notes_textarea');
    const notesLabel = document.getElementById('notes_label');

    // Populate vehicles by type
    vehicleTypeSelect.addEventListener('change', function () {
        const vehicleTypeId = this.value;
        vehicleSelect.innerHTML = '<option value="">Loading...</option>';

        if (vehicleTypeId) {
            fetch(`/get-vehicles-by-type/${vehicleTypeId}`)
                .then(response => response.json())
                .then(data => {
                    vehicleSelect.innerHTML = '<option value="">Select Vehicle</option>';
                    data.forEach(vehicle => {
                        const option = document.createElement('option');
                        option.value = vehicle.id;
                        option.text = `${vehicle.registration_number} (${vehicle.name || '-'})`;
                        vehicleSelect.appendChild(option);
                    });
                })
                .catch(() => {
                    vehicleSelect.innerHTML = '<option value="">Error loading vehicles</option>';
                });
        } else {
            vehicleSelect.innerHTML = '<option value="">Select Vehicle</option>';
        }
    });

    // Fuel type logic
    fuelSelect.addEventListener('change', function () {
        const selectedFuel = this.options[this.selectedIndex].text.toLowerCase();
        if (selectedFuel === 'benzine') {
            kmGroup.style.display = 'block';
            kmInput.required = true;
        } else {
            kmGroup.style.display = 'none';
            kmInput.required = false;
            kmInput.value = '';
        }
    });

    // Reason logic
    reasonSelect.addEventListener('change', function () {
        const reasonId = parseInt(this.value);

        if (reasonId === 2) {
            notesGroup.style.display = 'block';
            notesTextarea.required = true;
            notesTextarea.placeholder = 'Explain where to go';
            notesLabel.innerHTML = 'Explain where to go <span class="text-danger">*</span>';
        } else if (reasonId === 3) {
            notesGroup.style.display = 'block';
            notesTextarea.required = true;
            notesTextarea.placeholder = 'Provide description';
            notesLabel.innerHTML = 'Description or Specify Why <span class="text-danger">*</span>';
        } else {
            notesGroup.style.display = 'none';
            notesTextarea.required = false;
            notesTextarea.placeholder = '';
            notesTextarea.value = '';
            notesLabel.innerHTML = 'Notes';
        }
    });
});
</script>
@endpush


