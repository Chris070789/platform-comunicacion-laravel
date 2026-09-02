<x-app-layout>

    @section('content')
        <div class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-black text-white overflow-hidden">
            <x-slot name="header" class="p-0"></x-slot>

            {{-- Hero centrado con brillo --}}
            <div class="relative py-20 text-center">
                <h1
                    class="text-5xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-pink-400 via-purple-400 to-indigo-400 animate-pulse">
                    Agregar hito
                </h1>
                <p class="mt-2 text-lg text-gray-300">
                    Creá un nuevo hito para tu asignatura
                </p>
            </div>

            {{-- Formulario glass con brillo --}}
            <div class="max-w-3xl mx-auto px-6 pb-20">
                <div
                    class="bg-white/10 backdrop-blur-md rounded-2xl p-8 border border-white/20 shadow-2xl shadow-indigo-500/20">

                    <form method="POST" action="{{ route('docente.cronograma.store') }}">
                        @csrf

                        {{-- Título --}}
                        <div class="mb-6">
                            <label for="titulo" class="block text-sm font-medium text-gray-300 mb-2">
                                Título del hito
                            </label>
                            <input id="titulo" name="titulo" type="text" required
                                class="mt-1 block w-full rounded-md border-gray-300 text-black dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
                        </div>

                        {{-- Inicio --}}
                        <div class="mb-6">
                            <label for="inicio" class="block text-sm font-medium text-gray-300 mb-2">
                                Fecha de inicio
                            </label>
                            <input id="inicio" name="inicio" type="date" required
                                class="mt-1 block w-full rounded-md border-gray-300  bg-white text-gray-900   dark:border-gray-700  dark:bg-gray-800 dark:text-gray-100">
                        </div>

                {{-- Fin --}}
                <div class="mb-6">
                    <label for="fin" class="block text-sm font-medium text-gray-300 mb-2">
                        Fecha de fin (opcional)
                    </label>
                    <input id="fin" name="fin" type="date"
                        class="mt-1 block w-full rounded-md border-gray-300  bg-white text-gray-900   dark:border-gray-700  dark:bg-gray-800 dark:text-gray-100">
                </div>

                {{-- Botones con brillo --}}
                <div class="flex items-center justify-end gap-4">
                    <a href="{{ route('docente.cronograma.index') }}"
                        class="px-6 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg transition">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-gradient-to-r from-purple-500 to-pink-600 hover:from-purple-600 hover:to-pink-700 text-white rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-purple-500/50">
                        Guardar hito
                    </button>
                </div>
                </form>

            </div>
        </div>
        </div>
    @endsection>
</x-app-layout>
