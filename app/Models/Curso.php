<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'docente_id'];

    public function docente()
    {
        return $this->belongsTo(User::class, 'docente_id');
    }


    /***public function alumnos()
    {
        return $this->belongsToMany(User::class)->whereHas('roles', fn($q) => $q->where('name', 'alumno'));
    }***/

    public function alumnos()
    {
        return $this->belongsToMany(User::class, 'alumno_curso')->withTimestamps();
    }

    public function temas()
    {
        return $this->hasMany(Tema::class);
    }

    public function materiales(): HasMany
    {
        return $this->hasMany(Material::class);
    }

    public function docentes(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'curso_user',     // ← tabla correcta
            'curso_id',       // FK hacia Curso
            'user_id'         // FK hacia User
        );
    }
}
