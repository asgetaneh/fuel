<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\Request;
use App\Models\User;


class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $offices = Office::with(['parentOffice', 'manager'])->paginate(10);
        return view('offices.index', compact('offices'));
    }

    public function create() {
        $parentOffices = Office::all();
        $managers = User::all();
        return view('offices.create', compact('parentOffices', 'managers'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Office::create($request->all());
        return redirect()->route('offices.index')->with('success', 'Office created.');
    }

    public function show(Office $office) {
        return view('offices.show', compact('office'));
    }

    public function edit(Office $office) {
        $parentOffices = Office::where('id', '!=', $office->id)->get();
        $managers = User::all();
        return view('offices.edit', compact('office', 'parentOffices', 'managers'));
    }

    public function update(Request $request, Office $office) {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $office->update($request->all());
        return redirect()->route('offices.index')->with('success', 'Office updated.');
    }

    public function destroy(Office $office) {
        $office->delete();
        return redirect()->route('offices.index')->with('success', 'Office deleted.');
    }
}
