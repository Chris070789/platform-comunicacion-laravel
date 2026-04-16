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
}
