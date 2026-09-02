<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Biblioteca;
use Illuminate\Support\Facades\Auth;

class AlumnoBibliotecaController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $cursoIds = $user->cursosComoAlumno->pluck('id');
        $biblioteca = Biblioteca::whereIn('curso_id', $cursoIds)->get();

        return view('alumno.biblioteca.index', compact('biblioteca'));
    }

    public function show(Biblioteca $biblioteca)
    {
        if (!Auth::user()->cursosComoAlumno->contains('id', $biblioteca->curso_id)) {
            abort(403, 'No estás inscrito en este curso.');
        }

        return view('alumno.biblioteca.show', compact('biblioteca'));
    }
}
