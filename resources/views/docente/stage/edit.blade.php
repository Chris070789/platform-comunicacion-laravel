<x-app-layout>
    <x-slot name="header">
        <div class="text-center py-8">
            <h1
                class="text-4xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-pink-400 via-purple-400 to-indigo-400">
                Editar Etapa {{ $stage->name }}
            </h1>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto mt-10 bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        @if ($errors->any())
        <div style="background: #f8d7da; color: #721c24; padding: 15px; margin-bottom: 20px; border-radius: 5px;">
            <strong>¡Ups! Algo salió mal:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('docente.stage.update', $stage) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Título -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Título del ejercicio
                </label>
                <input type="text" name="name" id="name" value="{{ $stage->name }}" required
                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300
                           focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            </div>

            <!-- Descripción -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Descripción
                </label>
                <textarea name="description" id="description" rows="4"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300
                           focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ $stage->description }}</textarea>
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
                           transition duration-150 ease-in-out"
                    value="{{ $stage->max_points }}" required />
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

                <div id="questions-wrapper" class="space-y-4">
                    @foreach ($stage->questions as $qIndex => $question)
                    <div class="question-block p-4 bg-gray-50 dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-700 relative" data-index="{{ $qIndex }}">

                        <div class="flex justify-between items-center mb-3">
                            <label class="block text-xs font-bold text-gray-500 uppercase">Pregunta {{ $qIndex + 1 }}</label>
                            <button type="button" onclick="removeQuestion(this)" class="text-xs text-gray-400 hover:text-red-500 font-medium">
                                Eliminar Pregunta
                            </button>
                        </div>

                        <div class="mb-3">
                            <input type="text" name="questions[{{ $qIndex }}][content]"
                                value="{{ old('questions.'.$qIndex.'.content', $question->content) }}"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        </div>

                        <div class="options-container space-y-2">
                            @foreach ($question->options as $oIndex => $option)
                            <div class="flex items-center gap-2 option-row">
                                <input type="hidden" name="questions[{{ $qIndex }}][options][{{ $oIndex }}][is_correct]" value="0">
                                <input type="checkbox" name="questions[{{ $qIndex }}][options][{{ $oIndex }}][is_correct]" value="1"
                                    class="h-4 w-4 text-indigo-600 border-gray-300 rounded" @checked($option->is_correct)>

                                <input type="text" name="questions[{{ $qIndex }}][options][{{ $oIndex }}][option_text]"
                                    value="{{ old('questions.'.$qIndex.'.options.'.$oIndex.'.option_text', $option->option_text) }}"
                                    class="block w-full text-xs bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-600 dark:text-gray-300 rounded-md">

                                <button type="button" onclick="this.parentElement.remove()" class="text-gray-400 hover:text-red-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            @endforeach
                        </div>

                        <button type="button" onclick="addOption(this)" class="mt-3 text-xs text-indigo-600 dark:text-indigo-400 hover:underline">
                            + Añadir Opción
                        </button>
                    </div>
                    @endforeach
                </div>

                <button type="button" onclick="addQuestion()"
                    class="mt-4 inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-md hover:bg-green-700 transition">
                    + Añadir Pregunta
                </button>
            </div>

            <template id="question-template">
                <div class="question-block p-4 bg-gray-50 dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-700 relative">
                    <div class="flex justify-between items-center mb-3">
                        <label class="block text-xs font-bold text-gray-500 uppercase">Pregunta</label>
                        <button type="button" onclick="removeQuestion(this)" class="text-xs text-gray-400 hover:text-red-500 font-medium">
                            Eliminar Pregunta
                        </button>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="questions[__Q_INDEX__][content]" placeholder="Escribe la pregunta aquí..."
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    </div>
                    <div class="options-container space-y-2"></div>
                    <button type="button" onclick="addOption(this)" class="mt-3 text-xs text-indigo-600 dark:text-indigo-400 hover:underline">
                        + Añadir Opción
                    </button>
                </div>
            </template>

            <template id="option-template">
                <div class="flex items-center gap-2 option-row">
                    <input type="hidden" name="questions[__Q_INDEX__][options][__O_INDEX__][is_correct]" value="0">
                    <input type="checkbox" name="questions[__Q_INDEX__][options][__O_INDEX__][is_correct]" value="1"
                        class="h-4 w-4 text-indigo-600 border-gray-300 rounded">

                    <input type="text" name="questions[__Q_INDEX__][options][__O_INDEX__][option_text]" placeholder="Respuesta..."
                        class="block w-full text-xs bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-600 dark:text-gray-300 rounded-md">

                    <button type="button" onclick="this.parentElement.remove()" class="text-gray-400 hover:text-red-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </template>

            <div class="flex justify-end gap-2 mt-4">
                <a href="{{ route('docente.taller.stages', $stage->workshop_id) }}"
                    class="rounded-md bg-red-600 py-2 px-4 text-sm text-white transition-all shadow-md hover:bg-red-700 flex items-center">
                    ← Cancelar
                </a>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded text-sm shadow-md">
                    Actualizar Etapa
                </button>
            </div>
        </form>
    </div>
    <script>
        // Inicializamos el contador basado en la cantidad real de bloques en el DOM
        let questionCount = document.querySelectorAll('.question-block').length;

        function addQuestion() {
            const container = document.getElementById('questions-wrapper');
            const template = document.getElementById('question-template').innerHTML;

            // Insertamos el índice temporal de la pregunta
            let html = template.replace(/__Q_INDEX__/g, questionCount);

            const div = document.createElement('div');
            div.innerHTML = html;
            container.appendChild(div.firstElementChild);

            const lastQuestionBlock = container.lastElementChild;

            // Añadimos por defecto 2 opciones vacías a la nueva pregunta
            addOption(lastQuestionBlock.querySelector('button[onclick="addOption(this)"]'));
            addOption(lastQuestionBlock.querySelector('button[onclick="addOption(this)"]'));

            questionCount++;
            reindexAll(); // Forzamos un reordenamiento visual y de nombres limpio
        }

        function addOption(button) {
            const questionBlock = button.closest('.question-block');
            const optionsContainer = questionBlock.querySelector('.options-container');
            const template = document.getElementById('option-template').innerHTML;

            // Obtenemos el índice actual real de la pregunta desde su atributo de datos
            let qIndex = questionBlock.getAttribute('data-index');
            if (!qIndex) {
                const inputContent = questionBlock.querySelector('input[name*="[content]"]');
                qIndex = inputContent ? inputContent.name.match(/\d+/)[0] : '0';
            }

            const optIndex = optionsContainer.querySelectorAll('.option-row').length;

            // Reemplazamos los comodines unificados
            let html = template
                .replace(/__Q_INDEX__/g, qIndex)
                .replace(/__O_INDEX__/g, optIndex);

            const div = document.createElement('div');
            div.innerHTML = html;
            optionsContainer.appendChild(div.firstElementChild);
        }

        function removeQuestion(button) {
            if (confirm('¿Estás seguro de que deseas eliminar esta pregunta y todas sus opciones?')) {
                const questionBlock = button.closest('.question-block');
                questionBlock.remove();

                // Reindexación obligatoria para evitar saltos en los arrays que quiebren el Request de Laravel
                reindexAll();

                const container = document.getElementById('questions-wrapper');
                if (container.children.length === 0) {
                    addQuestion();
                }
            }
        }

        function reindexAll() {
            const container = document.getElementById('questions-wrapper');
            const questions = container.querySelectorAll('.question-block');

            questionCount = questions.length;

            questions.forEach((qBlock, qIndex) => {
                // Seteamos el índice de control de la pregunta
                qBlock.setAttribute('data-index', qIndex);

                // Actualizamos el texto del label (Ej: "Pregunta 1", "Pregunta 2")
                const label = qBlock.querySelector('label');
                if (label) {
                    label.textContent = `Pregunta ${qIndex + 1}`;
                }

                // Corregimos el atributo name del input de la pregunta
                const qInput = qBlock.querySelector('input[name*="[content]"]');
                if (qInput) qInput.name = `questions[${qIndex}][content]`;

                // Corregimos secuencialmente los names de todas sus opciones hijas
                const options = qBlock.querySelectorAll('.option-row');
                options.forEach((oRow, oIndex) => {
                    const hiddenCorrect = oRow.querySelector('input[type="hidden"]');
                    const checkCorrect = oRow.querySelector('input[type="checkbox"]');
                    const textInput = oRow.querySelector('input[type="text"]');

                    if (hiddenCorrect) hiddenCorrect.name = `questions[${qIndex}][options][${oIndex}][is_correct]`;
                    if (checkCorrect) checkCorrect.name = `questions[${qIndex}][options][${oIndex}][is_correct]`;
                    if (textInput) textInput.name = `questions[${qIndex}][options][${oIndex}][option_text]`;
                });
            });
        }

        // Inicialización segura del DOM
        document.addEventListener('DOMContentLoaded', () => {
            const container = document.getElementById('questions-wrapper');

            if (container && container.querySelectorAll('.question-block').length === 0) {
                addQuestion();
            } else {
                reindexAll();
            }
        });
    </script>
</x-app-layout>