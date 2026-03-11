<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Organisation;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['organisation', 'division'])->latest()->get();
        return view('backend.pages.user.index', compact('users'));
    }

    public function create()
    {
        $organisations = Organisation::all();
        $divisions = Division::all();
        return view('backend.pages.user.form', compact('organisations', 'divisions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required|in:super_admin,admin,leader,member',
            'organisation_id' => 'nullable|exists:organisations,id',
            'division_id' => 'nullable|exists:divisions,id',
            'phone' => 'nullable|string|max:20',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        $data['name'] = $request->full_name; // Sync name with full_name for DB constraint
        $data['password'] = Hash::make($request->password);
        $data['is_active'] = $request->has('is_active');

        User::create($data);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $organisations = Organisation::all();
        $divisions = Division::all();
        return view('backend.pages.user.form', compact('user', 'organisations', 'divisions'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:super_admin,admin,leader,member',
            'organisation_id' => 'nullable|exists:organisations,id',
            'division_id' => 'nullable|exists:divisions,id',
            'phone' => 'nullable|string|max:20',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        $data['name'] = $request->full_name; // Sync name with full_name for DB constraint
        if ($request->filled('password')) {
            $request->validate(['password' => 'min:8']);
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }
        $data['is_active'] = $request->has('is_active');

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
