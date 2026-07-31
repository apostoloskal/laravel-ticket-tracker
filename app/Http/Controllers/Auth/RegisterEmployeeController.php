<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\EmployeeProfile;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterEmployeeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
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
}
