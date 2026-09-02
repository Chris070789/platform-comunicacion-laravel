<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Biblioteca extends Model
{
    protected $table = 'biblioteca';
    protected $fillable = [
        'curso_id',
        'docente_id',
        'titulo',
        'descripcion',
        'tipo',
        'url',
        'archivo',
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function docente()
    {
        return $this->belongsTo(User::class, 'docente_id');
    }
}
