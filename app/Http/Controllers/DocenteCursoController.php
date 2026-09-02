<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Material;
use App\Models\Unidad;
use App\Models\Tema;
use App\Models\Cronograma;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\AssignOp\Mod;

class DocenteCursoController extends Controller
{

    /**
     * Muestra el panel de gestión del curso del docente logueado
     */
    public function index()
    {
        // 1. Todos los cursos del docente
        $cursoCollection = Auth::user()->cursosComoDocente;

        // 2. Si no hay cursos → dashboard con aviso
        if ($cursoCollection->isEmpty()) {
            return redirect()
                ->route('dashboard')
                ->with('warning', 'No tienes ningún curso asignado.');
        }

        // 3. Si hay cursos → tomamos el primero
        $curso = $cursoCollection->first();

        // 4. Cargar datos de ese curso
        $materiales  = Material::where('curso_id', $curso->id)->latest()->get();
        $unidades    = Unidad::where('curso_id', $curso->id)->orderBy('orden')->get();
        $cronogramas = Cronograma::where('curso_id', $curso->id)->orderBy('inicio')->get();

        return view('docente.curso.gestion', compact('curso', 'materiales', 'unidades', 'cronogramas'));
    }


}
