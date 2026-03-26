<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class WorkshopController extends Controller
{
    use AuthorizesRequests;
    public function create()
    {
        return view('docente.taller.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'max_points'  => 'required|integer|min:1',
        ]);

        $taller = Workshop::create([
            'title'        => $request->name,
            'description' => $request->description,
            'max_points'  => $request->max_points,
            'docente_id'  => Auth::id(),
        ]);

        return redirect()
            ->route('docente.taller.stages', $taller)
            ->with('success', 'Taller creado. Ahora agrega los ejercicios.');
    }

    public function index()
    {
        // Obtener solo los talleres del docente logueado
        /** @var User $user */
        $user = Auth::user();
        $talleres = Workshop::where('docente_id', $user->id)
            ->withCount('students')
            ->latest()
            ->get();
        //dd($talleres);
        return view('docente.taller.index', compact('talleres'));
    }

    public function edit(Workshop $workshop)
    {
        $this->authorize('update', $workshop); // ver Policy más abajo
        return view('docente.taller.edit', compact('workshop'));
    }

    public function update(Request $request, Workshop $workshop)
    {
        $this->authorize('update', $workshop);

        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'max_points'  => 'required|integer|min:1',
        ]);

        $workshop->update($request->only('name', 'description', 'max_points'));

        return redirect()
            ->route('dashboard')
            ->with('success', 'Taller actualizado.');
    }

    public function destroy(Workshop $workshop)
    {
        $this->authorize('delete', $workshop);
        $workshop->delete();

        return redirect()
            ->route('dashboard')
            ->with('success', 'Taller eliminado.');
    }
}
