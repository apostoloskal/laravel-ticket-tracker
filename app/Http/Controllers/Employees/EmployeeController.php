<?php

namespace App\Http\Controllers\Employees;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\EmployeeProfile;
use App\Models\User;
use Gate;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', EmployeeProfile::class);

        $employees = EmployeeProfile::with('user')
        ->whereHas('user', function ($query) {
            $query->whereNot('role', UserRole::E_ADMIN->value);
        })
        ->latest()
        ->paginate(10);

        return view('dashboard.list-employees', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', EmployeeProfile::class);

        return view('dashboard.register-employee');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', EmployeeProfile::class);

        if ($request->user()->role !== UserRole::E_ADMIN) {
            abort(403, 'Only administrators can create new employees.');
        }

        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|max:20',
            'full_name' => 'nullable|string|max:255',
            'job_title' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255'
        ]);

        DB::transaction(function() use ($validated) {
            $user = User::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => UserRole::E_EMPLOYEE
            ]);

            EmployeeProfile::create([
                'user_id' => $user->id,
                'full_name' => $validated['full_name'],
                'job_title' => $validated['job_title'],
                'department' => $validated['department']
            ]);
        });

        return back()->with('success', 'New employee registered successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmployeeProfile $employee)
    {
        Gate::authorize('delete', $employee);

        User::destroy($employee->user_id);

        return back()->with('success', 'Employee removed successfully.');
    }
}
