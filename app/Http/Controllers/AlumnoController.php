<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Curso;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    public function cursos()
    {
        $cursos = Auth::user()->cursosComoAlumno; // collection
        return view('alumno.cursos.index', compact('cursos')); // <- fixed
    }

    public function show(Curso $curso)
    {
        // Verificar que el alumno esté inscrito en el curso
        if (!Auth::user()->cursosComoAlumno->contains($curso)) {
            abort(403, 'No estás inscrito en este curso.');
        }

        return view('alumno.cursos.show', compact('curso'));
    }

    public function calificaciones()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Relación como propiedad (colección) con eager-load
        $calificaciones = $user->cursosComoAlumno
            ->load(['temas.calificaciones' => function ($q) {
                $q->where('user_id', Auth::id());
            }]);

        return view('alumno.calificaciones.index', compact('calificaciones'));
    }

    public function dashboard()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $workshop = $user->workshops()->first();   // o la lógica que uses
        $labels = [];
        $data = [];
        $labels = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'];
        $data = [10, 25, 15, 30, 20];
        $max = $workshop?->max_points ?? 100;

        if ($workshop) {
            foreach ($workshop->stages()->orderBy('position')->get() as $stage) {
                $labels[] = $stage->name;
                $data[]   = $stage->submissions()
                    ->where('user_id', $user->id)
                    ->sum('points_earned');
            }
            for ($i = 1; $i < count($data); $i++) $data[$i] += $data[$i - 1];
        }
        return view('dashboard', compact('workshop', 'labels', 'data', 'max'));
    }
}
