<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Biblioteca;
use Illuminate\Support\Facades\Auth;

class BibliotecaController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $curso = $user->cursosComoDocente()->first();
        if ($curso) {
            $biblioteca = Biblioteca::where('curso_id', $curso->id)->get();
        } else {
            // Manejo del error: redirigir, mostrar mensaje, etc.
            return redirect()->back()->with('error', 'Curso no encontrado');
        }


        return view('docente.biblioteca.index', compact('biblioteca'));
    }

    public function create()
    {
        return view('docente.biblioteca.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'tipo' => 'required|in:video,audio,imagen,pdf,enlace',
            'url' => 'nullable|url',
            'archivo' => 'nullable|file|mimes:mp4,mp3,png,jpg,pdf|max:20480', // 20 MB
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $curso = $user->cursosComoDocente()->first();

        $biblioteca = Biblioteca::create([
            'curso_id' => $curso->id,
            'docente_id' => Auth::id(),
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'tipo' => $request->tipo,
            'url' => $request->url,
            'archivo' => $request->file('archivo')?->store('biblioteca', 'public'),
        ]);

        return redirect()->route('docente.biblioteca.index')
            ->with('success', 'Recurso agregado.');
    }

    public function show(Biblioteca $biblioteca)
    {
        $user = Auth::user();

        // 1. ¿Es alumno del curso?
        $esAlumno = $user->cursosComoAlumno->contains($biblioteca->curso);

        // 2. ¿Es docente del curso?
        $esDocente = $biblioteca->curso->docente_id === $user->id;

        if (! ($esAlumno || $esDocente)) {
            abort(403, 'No tienes acceso a este contenido.');
        }

        return view('docente.biblioteca.show', compact('biblioteca'));
    }


    public function destroy($id)
    {
        // Buscar el recurso
        $recurso = Biblioteca::findOrFail($id);

        // Eliminarlo
        $recurso->delete();

        // Redirigir con mensaje
        return redirect()->route('docente.biblioteca.index')
            ->with('success', 'Recurso eliminado correctamente.');
    }
}
