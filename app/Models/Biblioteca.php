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

    public function getEmbedUrlAttribute()
    {
        if (!$this->url) {
            return null;
        }

        // Convertir URLs de Youtube (watch?v=, youtu.be/, shorts/) al formato /embed/
        $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/|youtube\.com\/shorts\/)([^"&?\/ ]{11})/';

        if (preg_match($pattern, $this->url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        return $this->url;
    }
}
