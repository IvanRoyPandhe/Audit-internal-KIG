<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::with(['seniorManager', 'users'])
            ->withCount('users')
            ->latest()
            ->paginate(10);

        return view('departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get users with auditee roles for SM selection
        $users = User::whereHas('role', function($query) {
            $query->whereIn('name', ['auditee_sm', 'auditee_em']);
        })->get();

        return view('departments.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepartmentRequest $request)
    {
        $department = Department::create($request->validated());

        // Update user to be department head if SM is assigned
        if ($request->sm_user_id) {
            User::where('id', $request->sm_user_id)->update([
                'department_id' => $department->id,
                'is_department_head' => true
            ]);
        }

        return redirect()->route('departments.index')
            ->with('success', 'Departemen berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        $department->load(['seniorManager', 'users.role']);
        
        return view('departments.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        // Get users with auditee roles for SM selection
        $users = User::whereHas('role', function($query) {
            $query->whereIn('name', ['auditee_sm', 'auditee_em']);
        })->get();

        return view('departments.edit', compact('department', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        // Remove old SM status if changed
        if ($department->sm_user_id && $department->sm_user_id != $request->sm_user_id) {
            User::where('id', $department->sm_user_id)->update([
                'is_department_head' => false
            ]);
        }

        $department->update($request->validated());

        // Update new SM
        if ($request->sm_user_id) {
            User::where('id', $request->sm_user_id)->update([
                'department_id' => $department->id,
                'is_department_head' => true
            ]);
        }

        return redirect()->route('departments.index')
            ->with('success', 'Departemen berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        // Check if department has users
        if ($department->users()->count() > 0) {
            return redirect()->route('departments.index')
                ->with('error', 'Tidak dapat menghapus departemen yang masih memiliki user.');
        }

        // Check if department has audit timelines
        if ($department->auditTimelines()->count() > 0) {
            return redirect()->route('departments.index')
                ->with('error', 'Tidak dapat menghapus departemen yang memiliki riwayat audit.');
        }

        $department->delete();

        return redirect()->route('departments.index')
            ->with('success', 'Departemen berhasil dihapus.');
    }

    /**
     * Assign users to department
     */
    public function assignUsers(Request $request, Department $department)
    {
        $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id'
        ]);

        User::whereIn('id', $request->user_ids)->update([
            'department_id' => $department->id
        ]);

        return redirect()->route('departments.show', $department)
            ->with('success', 'User berhasil ditambahkan ke departemen.');
    }
}
