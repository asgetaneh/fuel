<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Station;

class StationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $stations = Station::latest()->paginate(10);
        return view('stations.index', compact('stations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('stations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
         $request->validate(['name' => 'required|string|max:255']);
         Station::create($request->only('name', 'description'));
        return redirect()->route('stations.index')->with('success', 'Station created!');
    }

    /**
     * Display the specified resource.
     */
    public function edit($id) {
        $station = Station::findOrFail($id);
        return view('stations.edit', compact('station'));
    }

    public function update(Request $request, $id) {
        $station = Station::findOrFail($id);
        $request->validate(['name' => 'required|string|max:255']);
        $station->update($request->only('name', 'description'));
        return redirect()->route('stations.index')->with('success', 'Station updated!');
    }

    public function show($id) {
        $station = Station::findOrFail($id);
        return view('stations.show', compact('station'));
    }

    public function destroy($id) {
        $station = Station::findOrFail($id);
        $station->delete();
        return redirect()->route('stations.index')->with('success', 'Station deleted!');
    }
}
