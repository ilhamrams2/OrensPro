<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Organisation;
use Illuminate\Http\Request;

class OrganisationController extends Controller
{
    public function index()
    {
        $organisations = Organisation::latest()->get();
        return view('backend.pages.organisation.index', compact('organisations'));
    }

    public function create()
    {
        return view('backend.pages.organisation.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
        ]);

        Organisation::create($request->all());

        return redirect()->route('organisations.index')->with('success', 'Organisation created successfully.');
    }

    public function edit(Organisation $organisation)
    {
        return view('backend.pages.organisation.form', compact('organisation'));
    }

    public function update(Request $request, Organisation $organisation)
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
        ]);

        $organisation->update($request->all());

        return redirect()->route('organisations.index')->with('success', 'Organisation updated successfully.');
    }

    public function destroy(Organisation $organisation)
    {
        $organisation->delete();
        return redirect()->route('organisations.index')->with('success', 'Organisation deleted successfully.');
    }
}
