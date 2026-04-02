<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class StageController extends Controller
{
    use AuthorizesRequests;
    /* ---------- Listado de ejercicios ---------- */
    public function index(Workshop $workshop)
    {
        $this->authorize('update', $workshop); // mismo policy: solo el docente
        $stages = $workshop->stages()->orderBy('position')->get();

        return view('docente.taller.stages', compact('workshop', 'stages'));
    }

    /* ---------- Crear ejercicio (form) ---------- */
    public function create(Workshop $workshop)
    {
        $this->authorize('update', $workshop);
        return view('docente.stage.create', compact('workshop'));
    }

    /* ---------- Guardar ejercicio ---------- */
    public function store(Request $request, Workshop $workshop)
    {
        $this->authorize('update', $workshop);

        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'max_points'  => 'required|integer|min:1',
            'pdf'         => 'nullable|file|mimes:pdf|max:2048',
            'video'       => 'nullable|file|mimes:mp4,avi,mov,wmv|max:10240',

        ]);

        $lastPosition = $workshop->stages()->max('position') ?? 0;
        $pdfPath = null;
        $videoPath = null;
        if ($request->hasFile('pdf')) {
            $pdfPath = $request->file('pdf')->store('pdfs', 'public');
        }

        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('videos', 'public');
        }


        Stage::create([
            'workshop_id' => $workshop->id,
            'name'        => $request->name,
            'description' => $request->description,
            'max_points'  => $request->max_points,
            'position'    => $lastPosition + 1,
            'pdf'         => $pdfPath,
            'video'       => $videoPath,
        ]);

        return redirect()
            ->route('docente.taller.stages', ['workshop' => $workshop->id]);
    }

    /* ---------- Editar ejercicio ---------- */
    public function edit(Stage $stage)
    {
        $this->authorize('update', $stage->workshop);
        return view('docente.stage.edit', compact('stage'));
    }

    /* ---------- Actualizar ejercicio ---------- */
    public function update(Request $request, Stage $stage)
    {
        $this->authorize('update', $stage->workshop);

        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'max_points'  => 'required|integer|min:1',
        ]);

        $stage->update($request->only('name', 'description', 'max_points'));

        return redirect()
            ->route('docente.taller.stages', $stage->workshop)
            ->with('success', 'Ejercicio actualizado.');
    }

    /* ---------- Eliminar ejercicio ---------- */
    public function destroy(Stage $stage)
    {
        $this->authorize('update', $stage->workshop);
        $workshop = $stage->workshop;
        $stage->delete();

        // Reordenar posiciones (opcional pero limpio)
        $workshop->stages()->orderBy('position')->get()->each(function ($s, $key) {
            $s->update(['position' => $key + 1]);
        });

        return redirect()
            ->route('docente.taller.stages', $workshop)
            ->with('success', 'Ejercicio eliminado.');
    }
}
