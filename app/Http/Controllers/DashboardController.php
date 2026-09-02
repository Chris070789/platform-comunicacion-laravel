<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stage;
use App\Models\StageUserAnswer;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Traemos todas las etapas
        $stages = Stage::all();
        $totalStages = $stages->count();

        // Ahora sí, llamamos al método que definimos arriba
        $completedStages = $user->stages()
            ->wherePivot('completed', true)
            ->distinct('stages.id') // Usamos el ID de la etapa para no contar duplicados por pregunta
            ->count();

        $progress = $totalStages > 0 ? ($completedStages / $totalStages) * 100 : 0;

        return view('dashboard', compact('stages', 'progress', 'completedStages', 'totalStages'));
    }

    public function dashboard()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $totalQuestions = Question::count();
        $answeredQuestions = $user->answers()->count();

        $progress = $totalQuestions > 0
            ? ($answeredQuestions / $totalQuestions) * 100
            : 0;

        return view('dashboard', compact('progress', 'answeredQuestions', 'totalQuestions'));
    }

    public function showStage(Stage $stage)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();


        $totalQuestions = $stage->questions()->count();
        $answeredQuestions = StageUserAnswer::where('user_id', $user->id)
            ->where('stage_id', $stage->id)
            ->count();

        $progress = $totalQuestions > 0
            ? round(($answeredQuestions / $totalQuestions) * 100)
            : 0;

        return view('dashboard.stage', compact('stage', 'answeredQuestions', 'totalQuestions', 'progress'));
    }
}
