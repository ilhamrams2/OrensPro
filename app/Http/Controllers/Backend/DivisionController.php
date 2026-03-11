<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\Organisation;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function index()
    {
        $divisions = Division::with('organisation')->latest()->get();
        return view('backend.pages.division.index', compact('divisions'));
    }

    public function create()
    {
        $organisations = Organisation::all();
        return view('backend.pages.division.form', compact('organisations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'organisation_id' => 'required|exists:organisations,id',
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
        ]);

        Division::create($request->all());

        return redirect()->route('divisions.index')->with('success', 'Division created successfully.');
    }

    public function edit(Division $division)
    {
        $organisations = Organisation::all();
        return view('backend.pages.division.form', compact('division', 'organisations'));
    }

    public function update(Request $request, Division $division)
    {
        $request->validate([
            'organisation_id' => 'required|exists:organisations,id',
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
        ]);

        $division->update($request->all());

        return redirect()->route('divisions.index')->with('success', 'Division updated successfully.');
    }

    public function destroy(Division $division)
    {
        $division->delete();
        return redirect()->route('divisions.index')->with('success', 'Division deleted successfully.');
    }
}
