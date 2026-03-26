<?php

namespace App\Http\Controllers;

use App\Models\Tema;
use App\Models\Unidad;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TemaController extends Controller
{
    use AuthorizesRequests; // ← esto habilita $this->authorize()
    /**
     * Display a listing of the resource.
     */
    public function index(Unidad $unidad)
    {
        // eager-load if you’ll show docente / files later
        $temas = $unidad->temas()
            ->with('unidad.curso.docente')   // example
            ->orderBy('orden')
            ->get();
        return view('docente.temas.index', compact('unidad', 'temas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Unidad $unidad)
    {
        return view('docente.temas.create', compact('unidad'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Unidad $unidad)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'orden'  => 'nullable|integer|min:1',
        ]);
        if (!$unidad->curso_id) {
            return back()->with('error', 'La unidad no tiene curso asignado.');
        }

        $tema = $unidad->temas()->create([
            'titulo'    => $request->titulo,
            'orden'     => $request->orden ?? 1,
            'curso_id'  => $unidad->curso_id,
        ]);

        return redirect()->route('docente.unidades.temas.index', $unidad)
            ->with('success', 'Tema creado.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Unidad $unidad, Tema $tema)
    {
        return view('docente.temas.show', compact('unidad', 'tema'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unidad $unidad, Tema $tema)
    {
        $this->authorize('update', $unidad);
        return view('docente.temas.edit', compact('unidad', 'tema'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unidad $unidad, Tema $tema)
    {
        $this->authorize('update', $tema);   // política sobre el TEMA
        $request->validate([
            'titulo' => 'required|string|max:255',
            'resumen' => 'nullable|string',
            'orden' => 'nullable|integer|min:1',
            'fecha_limite' => 'nullable|date'
        ]);

        $tema->update($request->only(['titulo', 'resumen', 'orden', 'fecha_limite']));

        return redirect()->route('docente.unidades.temas.index', $unidad)
            ->with('success', 'Tema actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unidad $unidad, Tema $tema)
    {
        $this->authorize('delete', $tema);   // política sobre el TEMA
        $tema->delete();

        return redirect()->route('docente.unidades.temas.index', $unidad)
            ->with('success', 'Tema eliminado.');
    }
}
