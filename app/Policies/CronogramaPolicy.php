<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Cronograma;
use App\Models\User;

class CronogramaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('docente'); // o tu lógica
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Cronograma $cronograma): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('docente');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Cronograma $cronograma): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Cronograma $cronograma): bool
    {
        // si no hay curso, no permitimos borrar (o cambia la lógica si tu caso lo requiere)
        if (!$cronograma->curso) {
            return false;
        }

        return $user->id === $cronograma->curso->docente_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Cronograma $cronograma): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Cronograma $cronograma): bool
    {
        return false;
    }
}
