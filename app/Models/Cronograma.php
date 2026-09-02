<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cronograma extends Model
{

    protected $casts = [
        'inicio' => 'date',
        'fin'    => 'date',
    ];
    protected $fillable = [
        'curso_id',
        'titulo',
        'inicio',
        'fin',
        // cualquier otro campo que permitas crear masivamente
    ];
     public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

}
