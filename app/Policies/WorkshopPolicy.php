<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Workshop;
use App\Models\User;

class WorkshopPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    public function viewDashboard(User $user, Workshop $workshop): bool
    {
        // Admin puede ver cualquier taller
        if ($user->hasRole('admin')) {
            return true;
        }

        // Docente solo puede ver el taller que él creó
        if ($user->hasRole('docente')) {
            return $user->id === $workshop->teacher_id;
        }

        // Otros roles: denegar
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Workshop $workshop): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Workshop $workshop): bool
    {
       return $user->id === $workshop->docente_id || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Workshop $workshop): bool
    {
        return $user->id === $workshop->docente_id || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Workshop $workshop): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Workshop $workshop): bool
    {
        return false;
    }
}
