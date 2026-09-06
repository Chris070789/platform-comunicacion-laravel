<x-app-layout>
    <div class="min-h-screen bg-slate-900 bg-[radial-gradient(#38bdf8_1px,transparent_1px)] [background-size:24px_24px]">

        <x-slot name="header">
            <div class="text-center py-6">
                {{-- Encabezado divertido con estilo de juego --}}
                <span class="bg-yellow-400 text-yellow-900 font-extrabold px-4 py-1.5 rounded-full text-sm uppercase tracking-wider shadow-md">
                    🎯 ¡Misión Académica!
                </span>
                <h1 class="text-5xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-pink-400 via-purple-400 to-indigo-400 animate-pulse mt-3">
                    Etapa: {{ $stage->name }}
                </h1>
            </div>
        </x-slot>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 pb-20">
            {{-- Tarjeta Principal con efecto Glassmorphism y bordes redondeados infantiles --}}
            <div class="bg-slate-800/80 backdrop-blur-md rounded-3xl p-6 sm:p-8 border border-white/10 shadow-2xl space-y-8">

                {{-- Fila superior: Imagen, Descripción y Material (PDF) --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">

                    {{-- Columna 1: Imagen interactiva de la etapa --}}
                    <div class="bg-white dark:bg-gray-800 p-4 rounded-2xl shadow-lg border-2 border-indigo-400 overflow-hidden transform hover:scale-[1.02] transition-transform">
                        @if ($stage->image)
                        <img src="{{ asset('storage/' . $stage->image) }}" alt="{{ $stage->name }}"
                            class="w-full h-48 sm:h-56 object-cover rounded-xl shadow-inner">
                        @else
                        {{-- Imagen por defecto limpia sin divs duplicados --}}
                        <div class="w-full h-48 sm:h-56 bg-gradient-to-tr from-purple-500 to-indigo-600 rounded-xl flex flex-col items-center justify-center text-white p-4 text-center">
                            <img src="{{ asset('images/chacharaLogo.png') }}"
                                alt="Mascota"
                                class="h-24 w-auto mb-2 drop-shadow-md animate-bounce">
                            <span class="font-bold text-lg">¡Aprende y diviértete!</span>
                        </div>
                        @endif
                    </div>

                    {{-- Columna 2: Descripción y descarga de PDF --}}
                    <div class="space-y-4">
                        <div class="bg-white dark:bg-gray-800 p-5 rounded-2xl shadow-md border-b-4 border-purple-500">
                            <h3 class="text-lg font-bold text-purple-600 dark:text-purple-400 flex items-center gap-2 mb-2">
                                <i class="bi bi-chat-heart-fill"></i> ¿De qué trata esta etapa?
                            </h3>
                            <p class="text-gray-700 dark:text-gray-200 text-sm sm:text-base leading-relaxed">
                                {{ $stage->description }}
                            </p>
                        </div>

                        @if ($stage->pdf)
                        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-4 rounded-2xl shadow-md text-white flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <i class="bi bi-file-earmark-pdf-fill text-3xl text-red-300"></i>
                                <span class="font-bold text-sm">Material de lectura</span>
                            </div>
                            <a href="{{ asset('storage/' . $stage->pdf) }}" target="_blank"
                                class="bg-white text-blue-600 hover:bg-yellow-300 hover:text-blue-900 px-4 py-2 rounded-xl font-extrabold text-xs uppercase tracking-wide transition shadow">
                                📖 Leer PDF
                            </a>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Bloque del Cuestionario --}}
                <div class="bg-white dark:bg-gray-800 p-6 sm:p-8 rounded-3xl shadow-xl border-4 border-yellow-400">
                    <div class="flex items-center gap-3 mb-6 border-b border-gray-200 dark:border-gray-700 pb-4">
                        <span class="text-3xl">✏️</span>
                        <div>
                            <h3 class="text-xl sm:text-2xl font-black text-gray-800 dark:text-white">
                                Responde las preguntas
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Selecciona la respuesta que creas correcta</p>
                        </div>
                    </div>

                    {{-- Formulario corregido con evento onsubmit --}}
                    <form action="{{ route('alumno.stages.answer', $stage) }}" method="POST" onsubmit="mostrarCelebracion(event)" class="space-y-8">
                        @csrf

                        @foreach ($stage->questions as $qIndex => $question)
                        <div class="bg-indigo-50 dark:bg-gray-700/50 p-5 rounded-2xl border-2 border-indigo-200 dark:border-indigo-500/30">
                            {{-- Título de Pregunta --}}
                            <p class="text-base sm:text-lg font-extrabold text-indigo-900 dark:text-indigo-200 mb-4 flex items-start gap-2">
                                <span class="bg-indigo-600 text-white text-xs px-2.5 py-1 rounded-full font-black mt-0.5">
                                    #{{ $qIndex + 1 }}
                                </span>
                                {{ $question->content }}
                            </p>

                            {{-- Opciones de Respuesta --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                @foreach ($question->options as $option)
                                <label class="relative flex items-center p-4 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 hover:border-indigo-500 hover:bg-indigo-50/50 dark:hover:bg-indigo-900/30 cursor-pointer transition-all shadow-sm active:scale-95 group">
                                    <input type="radio"
                                        name="answers[{{ $question->id }}]"
                                        value="{{ $option->id }}"
                                        required
                                        class="w-5 h-5 text-indigo-600 border-gray-300 focus:ring-indigo-500 focus:ring-2">

                                    <span class="ml-3 font-bold text-gray-700 dark:text-gray-200 text-sm group-hover:text-indigo-600 dark:group-hover:text-indigo-300">
                                        {{ $option->option_text }}
                                    </span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                        @endforeach

                        {{-- Botón de envío lúdico --}}
                        <div class="pt-4">
                            <button type="submit"
                                class="w-full py-4 bg-gradient-to-r from-green-400 via-emerald-500 to-teal-600 hover:from-green-500 hover:to-teal-700 text-white font-black text-lg sm:text-xl rounded-2xl shadow-lg shadow-green-500/30 hover:shadow-green-500/50 transform hover:-translate-y-1 active:translate-y-0 transition-all flex items-center justify-center gap-3">
                                <span>🚀 ¡Entregar y Ganar Puntos!</span>
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

        {{-- Ventana Emergente Modal (Ubicada fuera del form) --}}
        <div id="modal-celebracion" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-slate-900/80 backdrop-blur-md p-4">
            <div class="bg-slate-800 border-4 border-yellow-400 rounded-3xl p-8 max-w-sm w-full text-center shadow-2xl transform scale-95 transition-transform duration-300" id="modal-card">

                {{-- Icono animado --}}
                <div class="w-20 h-20 bg-yellow-400 text-yellow-900 rounded-full flex items-center justify-center mx-auto mb-4 text-4xl shadow-lg animate-bounce">
                    🏆
                </div>

                {{-- Mensaje motivacional --}}
                <h3 class="text-2xl font-black text-white mb-2">¡Increíble Trabajo!</h3>
                <p class="text-indigo-200 text-sm font-semibold mb-6">
                    Estamos guardando tus respuestas y calculando tus puntos...
                </p>

                {{-- Loader y Cuenta Regresiva --}}
                <div class="flex items-center justify-center gap-3 bg-slate-700/60 py-3 px-4 rounded-xl border border-slate-600">
                    <div class="w-5 h-5 border-2 border-yellow-400 border-t-transparent rounded-full animate-spin"></div>
                    <span class="text-xs font-bold text-yellow-300">Enviando en <span id="contador">3</span> segundos...</span>
                </div>
            </div>
        </div>

    </div>

    {{-- Script JavaScript --}}
    <script>
        function mostrarCelebracion(event) {
            // Detiene el envío inmediato del formulario
            event.preventDefault();

            const form = event.target;
            const modal = document.getElementById('modal-celebracion');
            const modalCard = document.getElementById('modal-card');
            const contadorEl = document.getElementById('contador');

            // Muestra el modal con animación
            modal.classList.remove('hidden');
            setTimeout(() => {
                modalCard.classList.remove('scale-95');
                modalCard.classList.add('scale-100');
            }, 10);

            // Cuenta regresiva de 3 segundos antes de enviar
            let segundos = 3;
            const intervalo = setInterval(() => {
                segundos--;
                contadorEl.textContent = segundos;

                if (segundos <= 0) {
                    clearInterval(intervalo);
                    form.submit(); // Envía el formulario a Laravel
                }
            }, 1000);
        }
    </script>
</x-app-layout>