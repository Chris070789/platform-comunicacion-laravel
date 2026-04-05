<x-app-layout>
    <x-slot name="header">
        <div class="text-center py-8">
            <h1
                class="text-4xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-pink-400 via-purple-400 to-indigo-400">
                Nueva Etapa {{ $workshop->title }}
            </h1>
        </div>
    </x-slot>

<<<<<<< HEAD
    <div class="max-w-4xl mx-auto mt-10 grid grid-cols-1 md:grid-cols-3 gap-6 px-4 pb-12">
=======
    <div class="max-w-2xl mx-auto mt-10 bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
>>>>>>> 26e60e7a559b73994959483d3fcad613cbf57b43

        <div
            class="md:col-span-2 bg-white dark:bg-gray-800 p-6 rounded-lg shadow border border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Configuración de la Etapa</h3>

<<<<<<< HEAD
            <form action="{{ route('docente.stages.store', $workshop) }}" method="POST" enctype="multipart/form-data">
=======
            <form action="{{ route('docente.stages.store', $workshop->id) }}" method="POST" enctype="multipart/form-data">
>>>>>>> 26e60e7a559b73994959483d3fcad613cbf57b43
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Título del
                        ejercicio</label>
                    <input type="text" name="name" id="name" required
                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                </div>

<<<<<<< HEAD
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

=======
                <!-- Descripción -->
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Descripción
                    </label>
                    <textarea name="description" id="description" rows="4"
                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300
                           focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
                </div>


                <!-- Puntos máximos -->
                <div class="mt-4">
                    <label for="max_points" class="block text-sm font-medium text-gray-300 mb-2">
                        Puntuación máxima
                    </label>
                    <x-text-input id="max_points" name="max_points" type="number"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg
                           bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100
                           focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                           transition duration-150 ease-in-out" />
                </div>

                <!-- PDF -->
                <div class="mb-4">
                    <label for="pdf" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Subir PDF
                    </label>
                    <input type="file" name="pdf" id="pdf" accept="application/pdf"
                        class="mt-1 block w-full text-gray-700 dark:text-gray-300">
                </div>

                <!-- Video -->
                <div class="mb-4">
                    <label for="video" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Subir Video
                    </label>
                    <input id="video" name="video" type="file" accept="video/*"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg
                           bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100
                           focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                           transition duration-150 ease-in-out">
                </div>

                <div class="mb-6">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Cuestionario</h3>

                    <div id="quiz-container" class="space-y-6">
                    </div>

                    <button type="button" onclick="addQuestion()"
                        class="mt-4 inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-md hover:bg-green-700 transition">
                        + Añadir Pregunta
                    </button>
                </div>

                <template id="question-template">
                    <div
                        class="question-block p-4 bg-gray-50 dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-700 relative">
                        <button type="button" onclick="removeQuestion(this)"
                            class="text-gray-400 hover:text-red-500">Eliminar</button>

                        <div class="mb-3">
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nueva Pregunta</label>
                            <input type="text" name="questions[INDEX][content]" placeholder="Escribe la pregunta..."
                                class="block w-full bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 dark:text-white rounded-md text-sm">
                        </div>

                        <div class="options-container space-y-2">
                        </div>

                        <button type="button" onclick="addOption(this)"
                            class="mt-3 text-xs text-indigo-600 dark:text-indigo-400 hover:underline">
                            + Añadir Opción
                        </button>
                    </div>
                </template>

                <template id="option-template">
                    <div class="flex items-center gap-2 option-row">
                        <input type="hidden" name="questions[INDEX][options][__OPT__][is_correct]" value="0">
                        <input type="checkbox" name="questions[INDEX][options][__OPT__][is_correct]" value="1"
                            class="h-4 w-4 text-indigo-600 border-gray-300 rounded">

                        <input type="text" name="questions[INDEX][options][__OPT__][option_text]"
                            placeholder="Respuesta..."
                            class="block w-full text-xs bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-600 dark:text-gray-300 rounded-md">

                        <button type="button" onclick="this.parentElement.remove()"
                            class="text-gray-400 hover:text-red-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </template>


>>>>>>> 26e60e7a559b73994959483d3fcad613cbf57b43
                <div class="flex justify-end mt-6">
                    <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-lg transition shadow-lg">
                        Guardar Etapa
                    </button>
                </div>
            </form>
        </div>

<<<<<<< HEAD
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
=======
    </div>
    <script>
        let questionCount = 0;

        function addQuestion() {
            const container = document.getElementById('quiz-container');
            const template = document.getElementById('question-template').innerHTML;

            let html = template.replace(/INDEX/g, questionCount);

            const div = document.createElement('div');
            div.innerHTML = html;
            container.appendChild(div.firstElementChild);

            const lastQuestionBlock = container.lastElementChild;
            addOption(lastQuestionBlock.querySelector('button[onclick="addOption(this)"]'));
            addOption(lastQuestionBlock.querySelector('button[onclick="addOption(this)"]'));

            questionCount++;
        }

        function addOption(button) {
            const questionBlock = button.closest('.question-block');
            const optionsContainer = questionBlock.querySelector('.options-container');
            const template = document.getElementById('option-template').innerHTML;

            const qIndex = questionBlock.querySelector('input[name*="[content]"]').name.match(/\d+/)[0];
            const optIndex = optionsContainer.querySelectorAll('.option-row').length;

            let html = template.replace(/INDEX/g, qIndex).replace(/__OPT__/g, optIndex);

            const div = document.createElement('div');
            div.innerHTML = html;
            optionsContainer.appendChild(div.firstElementChild);
        }

        function removeQuestion(button) {
            // Confirmamos antes de borrar para evitar accidentes
            if (confirm('¿Estás seguro de que deseas eliminar esta pregunta y todas sus opciones?')) {
                const questionBlock = button.closest('.question-block');
                questionBlock.remove();

                // Opcional: Si quieres que siempre haya al menos una pregunta,
                // puedes verificar si el contenedor quedó vacío y llamar a addQuestion()
                const container = document.getElementById('quiz-container');
                if (container.children.length === 0) {
                    addQuestion();
                }
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            addQuestion();
        });
>>>>>>> 26e60e7a559b73994959483d3fcad613cbf57b43
    </script>
</x-app-layout>
