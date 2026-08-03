<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\EmployeeProfile;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EmployeePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        if ($user->role !== UserRole::E_ADMIN) {
            return Response::denyAsNotFound();
        }

        return Response::allow();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, EmployeeProfile $employeeProfile): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === UserRole::E_ADMIN;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, EmployeeProfile $employeeProfile): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, EmployeeProfile $employeeProfile): bool
    {
        return $user->role === UserRole::E_ADMIN;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, EmployeeProfile $employeeProfile): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, EmployeeProfile $employeeProfile): bool
    {
        return false;
    }
}
