<?php

namespace App\Http\Controllers;

use App\Models\Fuel;
use App\Models\Measurement;
use Illuminate\Http\Request;

class FuelController extends Controller
{
    public function index()
    {
        $fuels = Fuel::with('measurement')->paginate(10);
        return view('fuels.index', compact('fuels'));
    }

    public function create()
    {
        $measurements = Measurement::all();
        return view('fuels.create', compact('measurements'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:fuels,slug',
            'measurement_id' => 'required|exists:measurements,id',
        ]);

        Fuel::create($request->all());

        return redirect()->route('fuels.index')->with('success', 'Fuel created successfully.');
    }

    public function show(Fuel $fuel)
    {
        $fuel->load('measurement');
        return view('fuels.show', compact('fuel'));
    }

    public function edit(Fuel $fuel)
    {
        $measurements = Measurement::all();
        return view('fuels.edit', compact('fuel', 'measurements'));
    }

    public function update(Request $request, Fuel $fuel)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'measurement_id' => 'required|exists:measurements,id',
        ]);

        $fuel->update($request->all());

        return redirect()->route('fuels.index')->with('success', 'Fuel updated successfully.');
    }

    public function destroy(Fuel $fuel)
    {
        $fuel->delete();

        return redirect()->route('fuels.index')->with('success', 'Fuel deleted successfully.');
    }
}
