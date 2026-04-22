<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use App\Models\StageUserAnswer;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Importar al inicio


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
        //  dd($request->all());

        $this->authorize('update', $workshop);

        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'max_points'  => 'required|integer|min:1',
            'pdf'         => 'nullable|file|mimes:pdf|max:2048',
            'video'       => 'nullable|file|mimes:mp4,avi,mov,wmv|max:10240',
            // Validaciones para preguntas
            'questions'    => 'required|array|min:1',
            'questions.*.content' => 'required|string',
            'questions.*.options' => 'required|array|min:2',
            'questions.*.options.*.option_text' => 'required|string',
            'questions.*.options.*.is_correct'  => 'required|boolean',
        ]);

        DB::Transaction(
            function () use ($request, $workshop) {

                $lastPosition = $workshop->stages()->max('position') ?? 0;
                $pdfPath = null;
                $videoPath = null;
                if ($request->hasFile('pdf')) {
                    $pdfPath = $request->file('pdf')->store('pdfs', 'public');
                }

                if ($request->hasFile('video')) {
                    $videoPath = $request->file('video')->store('videos', 'public');
                }


                // 1. Crear el Stage
                $stage = Stage::create([
                    'workshop_id' => $workshop->id,
                    'name'        => $request->name,
                    'description' => $request->description,
                    'max_points'  => $request->max_points,
                    'position'    => $lastPosition + 1,
                    'pdf'         => $pdfPath,
                    'video'       => $videoPath,
                ]);



                foreach ($request->questions as $qData) {
                    $question = $stage->questions()->create([
                        'content' => $qData['content']
                    ]);

                    foreach ($qData['options'] as $oData) {
                        $question->options()->create([
                            'option_text' => $oData['option_text'],
                            'is_correct'  => $oData['is_correct'] ?? false,
                        ]);
                    }
                }
            }
        );

        return redirect()
            ->route('docente.taller.stages', ['workshop' => $workshop->id])
            ->with('success', 'Ejercicio y preguntas creados correctamente.');
    }



    /* ---------- Editar ejercicio ---------- */
    public function edit(Stage $stage)
    {
        $this->authorize('update', $stage->workshop);
        // Cargar preguntas y opciones relacionadas
        $stage->load('questions.options');
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
        if ($request->hasFile('pdf')) {
            $pdfPath = $request->file('pdf')->store('pdfs', 'public');
            $stage->pdf = $pdfPath;
        }

        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('videos', 'public');
            $stage->video = $videoPath;
        }

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
    /* ---------- ver ejercicio ---------- */
    public function show(Stage $stage)
    {
        $this->authorize('view', $stage);

        return view('alumno.stages.show', compact('stage'));
    }

    /*---------- Responder ejercicio ---------- */
    public function answer(Request $request, Stage $stage)
    {
        $answers = $request->input('answers', []); // si no hay, devuelve array vacío

        foreach ($answers as $questionId => $optionId) {

            StageUserAnswer::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'stage_id' => $stage->id,
                    'question_id' => $questionId,
                ],
                [
                    'option_id' => $optionId,
                    'completed' => true, // Marcar como completado al responder
                ]
            );
        }

        // Buscar el siguiente stage
        $nextStage = Stage::where('workshop_id', $stage->workshop_id)
            ->where('id', '>', $stage->id)
            ->orderBy('id')
            ->first();

        if (!is_null($nextStage)) {
            return redirect()->route('alumno.stages.show', $nextStage);
        }

        // Si no hay siguiente stage o si $stage->workshop_id es null
        return redirect()->route('dashboard')
            ->with('success', 'Has completado todos los stages');
    }
}
