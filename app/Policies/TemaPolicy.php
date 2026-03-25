<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Tema;
use App\Models\User;

class TemaPolicy
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
    public function view(User $user, Tema $tema): bool
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
    public function update(User $user, Tema $tema): bool
    {
        // El usuario es docente y da clase en el curso de la unidad del tema
        return $user->hasRole('docente')
            && $user->cursosComoDocente()
            ->where('cursos.id', $tema->unidad->curso_id)
            ->exists();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Tema $tema): bool
    {
         return true;   // o: return ! is_null($user);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Tema $tema): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Tema $tema): bool
    {
        return false;
    }
}
