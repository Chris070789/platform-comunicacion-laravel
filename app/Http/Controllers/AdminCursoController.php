<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminCursoController extends Controller
{
    public function index()
    {
        $cursos = Curso::whereNotNull('docente_id')
            ->with('docente')
            ->latest()
            ->get();
        return view('admin.cursos.index', compact('cursos'));
    }

    public function create()
    {
        $docentes = User::role('docente')->get();
        $alumnos  = User::role('alumno')->get();

        return view('admin.cursos.create', compact('docentes', 'alumnos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'     => 'required|string|max:255',
            'docente_id' => 'required|exists:users,id',
            'alumnos'    => 'nullable|array',
            'alumnos.*'  => 'exists:users,id',
        ]);

        $curso = Curso::create([
            'nombre' => $request->nombre,
            'docente_id' => $request->docente_id,
        ]);

        // Asignar alumnos
        if ($request->has('alumnos')) {
            $curso->alumnos()->attach($request->alumnos);
        }

        return redirect()->route('admin.cursos.index')
            ->with('success', 'Curso creado, docente y alumnos asignados.');
    }

    public function edit(Curso $curso)
    {
        $docentes = User::role('docente')->get();
        $alumnos = User::role('alumno')->get(); // ← faltaba esta

        return view('admin.cursos.edit', compact('curso', 'docentes', 'alumnos'));
    }

    public function update(Request $request, Curso $curso)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'docente_id' => 'required|exists:users,id',
        ]);

        $curso->update($request->only(['nombre', 'docente_id']));
        $curso->alumnos()->sync($request->input('alumnos', []));

        return redirect()->route('admin.cursos.index')
            ->with('success', 'Curso actualizado.');
    }

    public function destroy(Curso $curso)
    {
        $curso->delete();
        return redirect()->route('admin.cursos.index')
            ->with('success', 'Curso eliminado.');
    }
}
