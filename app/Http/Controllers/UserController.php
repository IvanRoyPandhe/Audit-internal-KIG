<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->latest()->paginate(15);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'employee_id' => 'nullable|string|unique:users',
            'department_id' => 'nullable|exists:departments,id',
            'position' => 'nullable|string',
            'role_id' => 'required|exists:roles,id',
            'password' => 'required|min:8',
            'is_active' => 'boolean',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['is_active'] = $request->has('is_active');

        User::create($validated);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'employee_id' => 'nullable|string|unique:users,employee_id,' . $user->id,
            'department_id' => 'nullable|exists:departments,id',
            'position' => 'nullable|string',
            'role_id' => 'required|exists:roles,id',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        }

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'User berhasil diupdate');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus');
    }

    /**
     * Display karyawan list (all users)
     */
    public function karyawan()
    {
        $karyawan = User::with(['role', 'departmentRelation'])
            ->latest()
            ->paginate(20);
        
        return view('karyawan.index', compact('karyawan'));
    }
}
