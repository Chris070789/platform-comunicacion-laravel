<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\User
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @method bool hasRole(string|array|\Spatie\Permission\Models\Role $roles)
 */

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function cursosComoDocente()
    {
        return $this->hasMany(Curso::class, 'docente_id');
    }

    public function cursosComoAlumno()
    {
        return $this->belongsToMany(Curso::class, 'alumno_curso')->withTimestamps();
        return $this->belongsToMany(Curso::class, 'alumno_curso', 'alumno_id', 'curso_id');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return match ($panel->getId()) {
            'admin'  => $this->hasRole('admin'),
            'docente' => $this->hasRole('docente'),
            'alumno'  => $this->hasRole('alumno'),
            default  => false,
        };
    }



    public function workshops()
    {
        return $this->belongsToMany(Workshop::class, 'workshop_user');
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    public function docenteWorkshops()
    {
        return $this->hasMany(Workshop::class, 'docente_id');
    }
}
