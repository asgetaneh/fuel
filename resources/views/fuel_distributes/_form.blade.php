@php
    $fd = $fuelDistribute ?? null;
@endphp

<div class="mb-3">
    <label for="vehicle_id" class="form-label">Vehicle</label>
    <select name="vehicle_id" class="form-control">
        <option value="">Select Vehicle</option>
        @foreach($vehicles as $vehicle)
            <option value="{{ $vehicle->id }}" {{ old('vehicle_id', $fd->vehicle_id ?? '') == $vehicle->id ? 'selected' : '' }}>
                {{ $vehicle->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="amount" class="form-label">Amount (Liters)</label>
    <input type="number" name="amount" step="0.01" class="form-control" value="{{ old('amount', $fd->amount ?? '') }}">
</div>

<div class="mb-3">
    <label for="date" class="form-label">Date</label>
    <input type="date" name="date" class="form-control" value="{{ old('date', isset($fd->date) ? \Carbon\Carbon::parse($fd->date)->format('Y-m-d') : '') }}">
</div>

<div class="mb-3">
    <label for="station_id" class="form-label">Station</label>
    <select name="station_id" class="form-control">
        <option value="">Select Station</option>
        @foreach($stations as $station)
            <option value="{{ $station->id }}" {{ old('station_id', $fd->station_id ?? '') == $station->id ? 'selected' : '' }}>
                {{ $station->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="notes" class="form-label">Notes</label>
    <textarea name="notes" class="form-control">{{ old('notes', $fd->notes ?? '') }}</textarea>
</div>
