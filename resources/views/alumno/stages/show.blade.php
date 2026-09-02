<x-app-layout>

    <x-slot name="header">
        <div class="text-center py-8">

            <h1
                class="text-4xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-pink-400 via-purple-400 to-indigo-400">
                Etapa {{ $stage->name }}
            </h1>
        </div>
    </x-slot>
    <div class="max-w-3xl mx-auto px-6 pb-20">
        <div class="bg-white/10 backdrop-blur-md rounded-2xl p-8 border border-white/20 shadow-2xl shadow-indigo-500/20">
            <div class="max-w-4xl mx-auto mt-10 grid grid-cols-1 md:grid-cols-3 gap-6 px-4 pb-12">

                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">Descripción de la etapa</h3>
                    <p class="text-gray-900 dark:text-gray-100">{{ $stage->description }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border border-gray-200 dark:border-gray-700">
                    <a href="{{ asset('storage/' . $stage->pdf) }}" target="_blank" class="text-blue-600 underline">
                        Ver PDF
                    </a>
                </div>
                <div
                    class="md:col-span-2 bg-white dark:bg-gray-800 p-6 rounded-lg shadow border border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">Marca la opción correcta</h3>

                    <form action="{{ route('alumno.stages.answer', $stage) }}" method="POST">
                        @csrf

                        @foreach ($stage->questions as $qIndex => $question)
                            <div class="mb-4">
                                <p class="font-semibold text-gray-900 dark:text-gray-100">{{ $question->content }}</p>
                                @foreach ($question->options as $option)
                                    <div>
                                        <input type="radio" name="answers[{{ $question->id }}]"
                                            value="{{ $option->id }}">
                                        <label
                                            class="text-gray-700 dark:text-gray-300">{{ $option->option_text }}</label>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach

                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">
                            Guardar y continuar
                        </button>
                    </form>


                </div>

            </div>
        </div>
</x-app-layout>
