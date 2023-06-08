<?php

namespace App\Policies;

use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DepartmentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->role_id === Role::IS_ADMIN;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Department $department): bool
    {
        return $user->role_id === Role::IS_ADMIN || (($user->role_id === Role::IS_MANAGER || $user->role_id === Role::IS_USER) && $user->organisation_id === $department->organisation_id);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role_id === Role::IS_ADMIN || $user->role_id === Role::IS_MANAGER;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Department $department): bool
    {
        return $user->role_id === Role::IS_ADMIN || ($user->role_id === Role::IS_MANAGER && $user->organisation_id === $department->organisation_id);
    }

    /**
     * Determine whether the user can create models.
     */
    public function selectOrganisation(User $user): bool
    {
        return $user->role_id === Role::IS_ADMIN;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Department $department): bool
    {
        return $user->role_id === Role::IS_ADMIN || ($user->role_id === Role::IS_MANAGER && $user->organisation_id === $department->organisation_id);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Department $department): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Department $department): bool
    {
        //
    }
}
