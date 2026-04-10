<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Curso;
use Illuminate\Http\Request;
use App\Models\Stage;

class AlumnoController extends Controller
{
    public function cursos()
    {
        $cursos = Auth::user()->cursosComoAlumno;
        $stages = Stage::all();
         return view('alumno.cursos.index', compact('cursos', 'stages'));
    }



    public function show(Curso $curso)
    {
        // Verificar que el alumno esté inscrito en el curso
        if (!Auth::user()->cursosComoAlumno->contains($curso)) {
            abort(403, 'No estás inscrito en este curso.');
        }

        return view('alumno.cursos.show', compact('curso'));
    }
}
