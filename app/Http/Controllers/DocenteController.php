<?php

namespace App\Http\Controllers;

use App\Models\Workshop;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    public function cursos()
    {
        // cursos que imparte el docente logueado
        $cursos = Auth::user()->cursosComoDocente;   // o auth()->user()->cursos;
        return view('docente.cursos', compact('cursos'));
    }

    public function alumnos()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $cursos = $user->cursosComoDocente()->with('alumnos')->get();
        $alumnos = $cursos->flatMap->alumnos->unique('id');

        return view('docente.alumnos', compact('cursos', 'alumnos'));
    }

    public function tallerDashboard(Workshop $taller)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        abort_if($taller->teacher_id !== $user->id, 403);
        $series = [];
        $labels = [];
        foreach ($taller->stages()->orderBy('position')->get() as $s) {
            $labels[] = $s->name;
        }
        foreach ($taller->students as $stu) {
            $data = [];
            foreach ($taller->stages as $st) {
                $data[] = $st->submissions()
                    ->where('user_id', $stu->id)
                    ->sum('points_earned');
            }
            // acumulado
            for ($i = 1; $i < count($data); $i++) $data[$i] += $data[$i - 1];
            $series[] = ['label' => $stu->name, 'data' => $data];
        }
        return view('docente.taller.dashboard', compact('taller', 'labels', 'series'));
    }
}
