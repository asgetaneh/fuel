<?php
// 3. Controller: app/Http/Controllers/FuelPriceController.php
namespace App\Http\Controllers;

use App\Models\Fuel;
use App\Models\FuelPrice;
use Illuminate\Http\Request;

class FuelPriceController extends Controller
{
    public function index()
    {
        $fuelPrices = FuelPrice::with('fuel')->paginate(10);
        return view('fuel_prices.index', compact('fuelPrices'));
    }

    public function create()
    {
        $fuels = Fuel::all();
        return view('fuel_prices.create', compact('fuels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'price_in_ETB' => 'required|numeric',
            'fuel_id' => 'required|exists:fuels,id',
            'date' => 'required|date',
            'is_active' => 'nullable|boolean',
        ]);

        FuelPrice::create([
            'price_in_ETB' => $request->price_in_ETB,
            'fuel_id' => $request->fuel_id,
            'date' => $request->date,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('fuel-prices.index')->with('success', 'Fuel price recorded successfully.');
    }

    public function show(FuelPrice $fuelPrice)
    {
        return view('fuel_prices.show', compact('fuelPrice'));
    }

    public function edit(FuelPrice $fuelPrice)
    {
        $fuels = Fuel::all();
        return view('fuel_prices.edit', compact('fuelPrice', 'fuels'));
    }

    public function update(Request $request, FuelPrice $fuelPrice)
    {
        $request->validate([
            'price_in_ETB' => 'required|numeric',
            'fuel_id' => 'required|exists:fuels,id',
            'date' => 'required|date',
            'is_active' => 'nullable|boolean',
        ]);

        $fuelPrice->update([
            'price_in_ETB' => $request->price_in_ETB,
            'fuel_id' => $request->fuel_id,
            'date' => $request->date,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('fuel-prices.index')->with('success', 'Fuel price updated successfully.');
    }

    public function destroy(FuelPrice $fuelPrice)
    {
        $fuelPrice->delete();
        return redirect()->route('fuel-prices.index')->with('success', 'Fuel price deleted successfully.');
    }
}
