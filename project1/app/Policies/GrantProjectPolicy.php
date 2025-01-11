<?php

namespace App\Policies;

use App\Models\GrantProject;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class GrantProjectPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, GrantProject $grantProject): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, GrantProject $grantProject): bool
    {
        return $user->role === 'admin' || 
               $user->role === 'staff' ||
               ($user->role === 'academician' && 
                $grantProject->project_leader_id === $user->academician->academician_id);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, GrantProject $grantProject): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, GrantProject $grantProject): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, GrantProject $grantProject): bool
    {
        return false;
    }

    // Manage Members
    public function manageMembers(User $user, GrantProject $grantProject)
    {
        return $user->role === 'admin' || 
               ($user->role === 'academician' && 
                $grantProject->project_leader_id === $user->academician->academician_id);
    }
}
