<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Stage;

class StagePolicy
{
    /**
     * Determina si el usuario puede ver cualquier Stage.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('admin') || $user->hasPermissionTo('view stages');
    }

    /**
     * Determina si el usuario puede ver un Stage específico.
     */
    public function view(User $user, Stage $stage): bool
    {
        // Admin siempre puede
        if ($user->hasRole('admin')) {
            return true;
        }

        // El dueño del stage (docente)
        if ($user->id === $stage->user_id) {
            return true;
        }

        // Los alumnos también pueden ver
        if ($user->hasRole('alumno')) {
            return true;
        }

        return false;
    }

    /**
     * Determina si el usuario puede crear Stages.
     */
    public function create(User $user): bool
    {
        return $user->can('create stages');
    }

    /**
     * Determina si el usuario puede actualizar un Stage.
     */
    public function update(User $user, Stage $stage): bool
    {
        return $user->hasRole('docente') || $user->id === $stage->user_id;
    }

    /**
     * Determina si el usuario puede eliminar un Stage.
     */
    public function delete(User $user, Stage $stage): bool
    {
        return $user->hasRole('admin') || $user->id === $stage->user_id;
    }


}
