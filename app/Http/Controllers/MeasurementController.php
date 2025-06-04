<?php

// app/Http/Controllers/MeasurementController.php
namespace App\Http\Controllers;

use App\Models\Measurement;
use Illuminate\Http\Request;
use App\Http\Requests\MeasurementRequest;

class MeasurementController extends Controller
{
    public function index()
    {
        $measurements = Measurement::latest()->paginate(10);
        return view('measurements.index', compact('measurements'));
    }

    public function create()
    {
        return view('measurements.create');
    }

    public function store(MeasurementRequest $request)
    {
        Measurement::create($request->validated());
        return redirect()->route('measurements.index')->with('success', 'Measurement created successfully.');
    }

    public function show(Measurement $measurement)
    {
        return view('measurements.show', compact('measurement'));
    }

    public function edit(Measurement $measurement)
    {
        return view('measurements.edit', compact('measurement'));
    }

    public function update(MeasurementRequest $request, Measurement $measurement)
    {
        $measurement->update($request->validated());
        return redirect()->route('measurements.index')->with('success', 'Measurement updated successfully.');
    }

    public function destroy(Measurement $measurement)
    {
        $measurement->delete();
        return redirect()->route('measurements.index')->with('success', 'Measurement deleted successfully.');
    }
}
