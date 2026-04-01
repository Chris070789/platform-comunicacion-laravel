<x-app-layout>
    <x-slot name="header">
        <div class="text-center py-8">
            <h1
                class="text-4xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-pink-400 via-purple-400 to-indigo-400">
                Nueva Etapa {{ $workshop->title }}
            </h1>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-10 grid grid-cols-1 md:grid-cols-3 gap-6 px-4 pb-12">

        <div
            class="md:col-span-2 bg-white dark:bg-gray-800 p-6 rounded-lg shadow border border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Configuración de la Etapa</h3>

            <form action="{{ route('docente.stages.store', $workshop) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Título del
                        ejercicio</label>
                    <input type="text" name="name" id="name" required
                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Vista previa del
                        cuestionario</label>
                    <div id="quiz-container" class="space-y-4">
                        @php
                            // Esto idealmente vendría de tu controlador, aquí un ejemplo rápido
                            $preguntas = [
                                [
                                    'id' => 1,
                                    'q' => '¿Qué es el emisor?',
                                    'options' => ['El que envía', 'El medio', 'El mensaje'],
                                ],
                                [
                                    'id' => 2,
                                    'q' => '¿Qué es el código?',
                                    'options' => ['Luz', 'Sistema de signos', 'El cable'],
                                ],
                            ];
                        @endphp

                        @foreach ($preguntas as $index => $item)
                            <div
                                class="p-4 bg-gray-50 dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-700">
                                <p class="text-sm font-semibold text-gray-700 dark:text-gray-200 mb-2">
                                    {{ $item['q'] }}</p>
                                @foreach ($item['options'] as $optIndex => $option)
                                    <div class="flex items-center mb-1">
                                        <input type="radio" name="q{{ $index }}"
                                            class="quiz-radio h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500"
                                            onchange="updateProgress()">
                                        <label
                                            class="ml-2 text-xs text-gray-600 dark:text-gray-400">{{ $option }}</label>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Puntos</label>
                        <x-text-input name="max_points" type="number" class="w-full" value="100" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">PDF</label>
                        <input type="file" name="pdf" class="block w-full text-xs text-gray-400">
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-lg transition shadow-lg">
                        Guardar Etapa
                    </button>
                </div>
            </form>
        </div>

        <div
            class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border border-gray-200 dark:border-gray-700 h-fit sticky top-6">
            <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-6 text-center">Progreso Real</h3>

            <div class="relative flex justify-center mx-auto max-w-[200px]">
                <canvas id="progressChart"></canvas>
                <div class="absolute inset-0 flex items-center justify-center flex-col">
                    <span id="percentText" class="text-3xl font-black text-indigo-500">0%</span>
                    <span class="text-[10px] uppercase tracking-widest text-gray-500 text-center">Completado</span>
                </div>
            </div>

            <div class="mt-8 space-y-4">
                <div class="flex justify-between text-xs font-medium dark:text-gray-400">
                    <span>Preguntas respondidas:</span>
                    <span id="answeredCount">0 / {{ count($preguntas) }}</span>
                </div>
                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-1.5">
                    <div id="miniBar" class="bg-indigo-500 h-1.5 rounded-full transition-all duration-500"
                        style="width: 0%"></div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const total = {{ count($preguntas) }};
        let chart;

        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('progressChart').getContext('2d');
            chart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: [0, total],
                        backgroundColor: ['#6366f1', '#374151'], // Indigo y Gris Oscuro
                        borderWidth: 0,
                        cutout: '85%'
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        tooltip: {
                            enabled: false
                        }
                    }
                }
            });
        });

        function updateProgress() {
            // Contar cuántos grupos de radio tienen selección
            const answered = document.querySelectorAll('.quiz-radio:checked').length;
            const percentage = Math.round((answered / total) * 100);

            // Actualizar texto y barra mini
            document.getElementById('percentText').innerText = percentage + '%';
            document.getElementById('answeredCount').innerText = `${answered} / ${total}`;
            document.getElementById('miniBar').style.width = percentage + '%';

            // Actualizar Chart.js
            chart.data.datasets[0].data = [answered, total - answered];
            chart.update();
        }
    </script>
</x-app-layout>
