@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Ejercicio: Conceptos de Comunicación</h2>

        <div class="progress mb-4" style="height: 25px;">
            <div id="progressBar" class="progress-bar bg-success" role="progressbar" style="width: 0%;">0%</div>
        </div>

        <form id="quizForm">
            @foreach ($preguntas as $index => $pregunta)
                <div class="card mb-3 question-card" data-question="{{ $index }}">
                    <div class="card-body">
                        <h5>{{ $index + 1 }}. {{ $pregunta['texto'] }}</h5>
                        @foreach ($pregunta['opciones'] as $opcion)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q{{ $index }}"
                                    value="{{ $opcion }}" onchange="updateProgress()">
                                <label class="form-check-label">{{ $opcion }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </form>

        <div class="mt-5" style="max-width: 400px;">
            <canvas id="advanceChart"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection
