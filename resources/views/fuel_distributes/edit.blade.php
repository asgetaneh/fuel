@extends('layouts.myapp')

@section('title', 'Edit Fuel Distribution')

@section('content')
<main class="app-main">
    <div class="app-content">
        <div class="container-fluid">
            <div class="card mb-4">
                <div class="card-header">
                    <h3>Edit Fuel Distribution</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('fuel_distributes.update', $fuelDistribute->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('fuel_distributes._form', ['fuelDistribute' => $fuelDistribute])
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('fuel_distributes.index') }}" class="btn btn-secondary">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
