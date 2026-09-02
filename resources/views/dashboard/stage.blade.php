@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
    <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-6 text-center">
        Progreso en la etapa: {{ $stage->name }}
    </h3>

    {{-- Gráfico principal --}}
    <div class="relative flex justify-center">
        <canvas id="progressChart" width="200" height="200"></canvas>
        <div class="absolute inset-0 flex items-center justify-center flex-col">
            <span id="percentText" class="text-3xl font-black text-indigo-500">
                {{ $progress }}%
            </span>
            <span class="text-[10px] uppercase tracking-widest text-gray-500">Completado</span>
        </div>
    </div>

    {{-- Barra secundaria --}}
    <div class="mt-8 space-y-4">
        <div class="flex justify-between text-xs font-medium dark:text-gray-400">
            <span>Preguntas respondidas:</span>
            <span id="answeredCount">{{ $answeredQuestions }} / {{ $totalQuestions }}</span>
        </div>
        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-1.5">
            <div id="miniBar" class="bg-indigo-500 h-1.5 rounded-full transition-all duration-500"
                 style="width: {{ $progress }}%"></div>
        </div>
    </div>
</div>

{{-- Script Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const total = {{ $totalQuestions }};
    const answered = {{ $answeredQuestions }};
    let chart;

    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('progressChart').getContext('2d');
        chart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [answered, total - answered],
                    backgroundColor: ['#6366f1', '#374151'], // Indigo y Gris Oscuro
                    borderWidth: 0,
                    cutout: '85%'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: { enabled: false }
                }
            }
        });
    });
</script>
@endsection
