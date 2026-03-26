<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cronograma;
use App\Models\Curso;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CronogramaController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $curso = $user->cursosComoDocente()->first();
        $cronogramas = Cronograma::where('curso_id', $curso->id)
            ->orderBy('inicio')
            ->get();
        return view('docente.cronograma.index', compact('cronogramas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('docente.cronograma.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'inicio' => 'required|date',
            'fin'    => 'nullable|date|after_or_equal:inicio',
        ]);


        /** @var \App\Models\User $user */
        $user = Auth::user();
        $curso = $user->cursosComoDocente()->first();

        Cronograma::create([
            'curso_id' => $curso->id,
            'titulo'   => $request->titulo,
            'inicio'   => $request->inicio,
            'fin'      => $request->fin,
        ]);

        return redirect()->route('docente.cronograma.index')
            ->with('success', 'Hito agregado.');
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
    public function edit(Cronograma $cronograma)
    {
        $this->authorize('update', $cronograma);
        return view('docente.cronograma.edit', compact('cronograma'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cronograma $cronograma)
    {

        $this->authorize('update', $cronograma);

        $request->validate([
            'titulo' => 'required|string|max:255',
            'inicio' => 'required|date',
            'fin'    => 'nullable|date|after_or_equal:inicio',
        ]);

        $cronograma->update($request->only(['titulo', 'inicio', 'fin']));

        return redirect()->route('docente.cronograma.index')
            ->with('success', 'Hito actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cronograma $cronograma)
    {
        $cronograma->load('curso');   // fuerza a traer el curso
        $this->authorize('delete', $cronograma);
        $cronograma->delete();

        return redirect()->route('docente.cronograma.index')
            ->with('success', 'Hito eliminado.');
    }
}
