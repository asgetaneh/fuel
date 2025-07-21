<!-- resources/views/fuels/create.blade.php -->
@extends('layouts.myapp')

@section('title', 'Create Fuel')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Create New Fuel</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('fuels.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                         <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <select name="slug" class="form-select" required>
                                <option value="">Select slug</option>
                                <option value="1">{{ "Benzine" }}</option>
                                <option value="2">{{ "Diesel" }}</option>
                                <option value="3">{{ "Gasoline" }}</option>
                                <option value="4">{{ "Kerosene" }}</option>
                                <option value="5">{{ "LPG" }}</option>
                                <option value="6">{{ "CNG" }}</option>
                                <option value="7">{{ "Ethanol" }}</option>
                                <option value="8">{{ "Methanol" }}</option>
                                <option value="9">{{ "Biodiesel" }}</option>
                                <option value="10">{{ "Coal" }}</option>
                                <option value="11">{{ "Electricity" }}</option>
                                <option value="12">{{ "Hydrogen" }}</option>
                                <option value="13">{{ "Propane" }}</option>
                                <option value="14">{{ "Butane" }}</option>
                                <option value="15">{{ "Natural Gas" }}</option>
                                <option value="16">{{ "Fuel Oil" }}</option>
                                <option value="17">{{ "Jet Fuel" }}</option>
                                <option value="18">{{ "Asphalt" }}</option>
                                <option value="19">{{ "Lubricants" }}</option>
                                <option value="20">{{ "Other" }}</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="measurement_id" class="form-label">Measurement</label>
                            <select name="measurement_id" class="form-select" required>
                                <option value="">Select</option>
                                @foreach($measurements as $measurement)
                                    <option value="{{ $measurement->id }}">{{ $measurement->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('fuels.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
