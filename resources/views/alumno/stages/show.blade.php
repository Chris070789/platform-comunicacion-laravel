<x-app-layout>

    <x-slot name="header">
        <div class="text-center py-8">
            <h1
                class="text-4xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-pink-400 via-purple-400 to-indigo-400">
                Etapa {{ $stage->name }}
            </h1>
        </div>
    </x-slot>
    <div class="max-w-2xl mx-auto mt-10 bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <div class="max-w-4xl mx-auto mt-10 grid grid-cols-1 md:grid-cols-3 gap-6 px-4 pb-12">

            <div
                class="md:col-span-2 bg-white dark:bg-gray-800 p-6 rounded-lg shadow border border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Marca la opción correcta</h3>

                <form action="{{ route('alumno.stages.answer', $stage) }}" method="POST">
                    @csrf

                    @foreach ($stage->questions as $qIndex => $question)
                        <div class="mb-4">
                            <p class="font-semibold">{{ $question->content }}</p>
                            @foreach ($question->options as $option)
                                <div>
                                    <input type="radio" name="answers[{{ $question->id }}]"
                                        value="{{ $option->id }}">
                                    <label>{{ $option->option_text }}</label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach

                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">
                        Guardar y continuar
                    </button>
                </form>


            </div>

            <div
                class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border border-gray-200 dark:border-gray-700 h-fit sticky top-6">
                <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-6 text-center">Progreso Real</h3>

                <div class="relative flex justify-center">
                    <canvas id="progressChart" width="200" height="200"></canvas>
                    <div class="absolute inset-0 flex items-center justify-center flex-col">
                        <span id="percentText" class="text-3xl font-black text-indigo-500">0%</span>
                        <span class="text-[10px] uppercase tracking-widest text-gray-500">Completado</span>
                    </div>
                </div>

                <div class="mt-8 space-y-4">
                    <div class="flex justify-between text-xs font-medium dark:text-gray-400">
                        <span>Preguntas respondidas:</span>
                        <span id="answeredCount">0 / {{ count($stage->questions) }}</span>
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
            const total = {{ count($stage->questions) }};
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
    </div>
</x-app-layout>
