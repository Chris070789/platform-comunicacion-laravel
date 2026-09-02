<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Unidad;
use App\Models\User;

class UnidadPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Unidad $unidad): bool
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
    public function update(User $user, Unidad $unidad)
    {
        // El usuario es docente y da clase en el curso de esa unidad
        return $user->hasRole('docente') &&
            $user->cursosComoDocente()->where('cursos.id', $unidad->curso_id)->exists();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Unidad $unidad): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Unidad $unidad): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Unidad $unidad): bool
    {
        return false;
    }
}
