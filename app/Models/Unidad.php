<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    protected $table = 'unidades';
    protected $fillable = [
        'curso_id',
        'titulo',
        'resumen',
        'orden',
    ];
    protected $casts = [
        'fecha_limite' => 'datetime:Y-m-d',   // o 'date' si solo necesitas día
    ];
    public function temas()
    {
        return $this->hasMany(Tema::class);
    }

    // Relación con el docente (dueño del curso)
    public function docente()
    {
        return $this->curso->docente(); // docente del curso
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'curso_id');
    }
}
