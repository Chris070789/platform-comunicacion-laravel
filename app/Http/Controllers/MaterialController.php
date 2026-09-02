<?php

namespace App\Http\Controllers;


use App\Models\Material;
use App\Models\Curso;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
//use Illuminate\Support\Facades\Log;

class MaterialController extends Controller
{

    use AuthorizesRequests; // ← esto habilita $this->authorize()
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();          // o auth()->user();
        $cursos = $user->cursosComoDocente()->orderBy('nombre')->get();
        $materiales = Material::with('curso')
            ->whereIn('curso_id', $cursos->pluck('id')) // <-- aplana a IDs
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('docente.materiales.index', compact('materiales', 'cursos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('docente.materiales.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'curso_id'  => 'required|exists:cursos,id',
            'titulo'    => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'archivo'   => 'required|file|mimes:pdf,doc,docx,zip|max:10240',
            'visible'   => 'boolean'
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // 1) Comprobar que el docente da clase en ese curso
        if (!$user->cursosComoDocente()->where('cursos.id', $request->input('curso_id'))->exists()) {
            abort(403, 'No estás autorizado para subir materiales a este curso.');
        }

        // 1) GUARDAR EL ARCHIVO --------------->
        $path = $request->file('archivo')->store('materiales', 'public');

        // 2) CREAR EL REGISTRO --------------->
        Material::create([
            'curso_id'    => $request->curso_id,
            'titulo'      => $request->titulo,
            'descripcion' => $request->descripcion,
            'file_path'   => $path,   // <- guardas la ruta relativa al disco "public"
            'visible'     => $request->boolean('visible', true),
        ]);


        return redirect()->route('materiales.index')
            ->with('success', 'Material agregado.');
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
    public function edit(Material $material)
    {

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $this->authorize('update', $material);

        // Carga la relación curso
        $material->load('curso');

        return view('docente.materiales.edit', compact('material'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Material $material)
    {
        $this->authorize('update', $material);   // ← debe ser 'update'

        $request->validate([
            'titulo'      => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'archivo'     => 'nullable|file|mimes:pdf,doc,docx,zip|max:10240',
            'visible'     => 'boolean',
        ]);

        // Si se subió un nuevo archivo
        if ($request->hasFile('archivo')) {
            // borrar el anterior
            Storage::disk('public')->delete($material->file_path);

            // guardar el nuevo
            $path = $request->file('archivo')->store('materiales', 'public');
            $material->file_path = $path;
        }

        // actualizar el resto de campos
        $material->update([
            'titulo'      => $request->titulo,
            'descripcion' => $request->descripcion,
            'visible'     => $request->boolean('visible', $material->visible),
        ]);

        return redirect()->route('materiales.index')
            ->with('success', 'Material actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Material $material)
    {
        $this->authorize('update', $material);
        Storage::disk('public')->delete($material->file_path);
        $material->delete();
        return redirect()->route('materiales.index')
            ->with('success', 'Material eliminado.');
    }
}
