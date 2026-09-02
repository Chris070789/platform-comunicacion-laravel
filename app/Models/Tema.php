<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'titulo',
        'curso_id',   // <-- indispensable
        'unidad_id',  // <-- también si lo vas a asignar masivamente
        'orden',
    ];

    /* Relaciones */
    public function unidad()
    {
        return $this->belongsTo(Unidad::class);
    }
}
