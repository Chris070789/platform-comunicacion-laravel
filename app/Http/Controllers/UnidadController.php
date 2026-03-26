<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unidad;
use App\Models\Curso;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UnidadController extends Controller
{

    use AuthorizesRequests; // ← esto habilita $this->authorize()
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();          // o auth()->user();
        $curso = $user->cursosComoDocente()->first(); // ¡Sin líneas rojas!
        $unidades = Unidad::where('curso_id', $curso->id)->orderBy('orden')->get();
        return view('docente.unidades.index', compact('unidades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('docente.unidades.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'resumen' => 'nullable|string',
            'orden' => 'nullable|integer|min:1',
            'fecha_limite' => 'nullable|date'
        ]);

        //$curso = Auth::user()->cursosComoDocente;
        /** @var \App\Models\User $user */
        $user = Auth::user();          // o auth()->user();
        $curso = $user->cursosComoDocente()->first(); // ¡Sin líneas rojas!
        Unidad::create([
            'curso_id' => $curso->id,
            'titulo' => $request->titulo,
            'resumen' => $request->resumen,
            'orden' => $request->orden ?? 1,
            'fecha_limite' => $request->fecha_limite,
        ]);

        return redirect()->route('docente.unidades.index')
            ->with('success', 'Unidad creada.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unidad $unidad)
    {
        // Verificar que el docente logueado sea el dueño
        if (Auth::user()->id !== $unidad->curso->docente_id) {
            abort(403, 'No autorizado');
        }

        return view('docente.unidades.edit', compact('unidad'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unidad $unidad)
    {
        $this->authorize('update', $unidad);
        $request->validate([
            'titulo' => 'required|string|max:255',
            'resumen' => 'nullable|string',
            'orden' => 'nullable|integer|min:1',
            'fecha_limite' => 'nullable|date'
        ]);

        $unidad->update($request->only(['titulo', 'resumen', 'orden', 'fecha_limite']));

        return redirect()->route('docente.unidades.index')
            ->with('success', 'Unidad actualizada.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unidad $unidad)
    {
        // Verificar que el docente logueado sea el dueño
        if (Auth::user()->id !== $unidad->curso->docente_id) {
            abort(403, 'No autorizado');
        }

        $unidad->delete();

        return redirect()->route('docente.curso.gestion')
            ->with('success', 'Unidad eliminada.');
    }
}
