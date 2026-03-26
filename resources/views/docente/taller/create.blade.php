<x-app-layout>

    @section('content')
        <div class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-black text-white">
            <div class="max-w-2xl mx-auto px-4">

                {{-- Hero centrado con brillo --}}
                <div class="relative py-20 text-center">
                    <h1
                        class="text-5xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-pink-400 via-purple-400 to-indigo-400 animate-pulse">
                        Crear Taller
                    </h1>

                    <p class="mt-2 text-lg text-gray-300">
                        Crear ejercicios para compartir con tus alumnos
                    </p>
                </div>
                {{-- Formulario glass con brillo --}}
                <div class="max-w-3xl mx-auto px-6 pb-20">
                    <div
                        class="bg-white/10 backdrop-blur-md rounded-2xl p-8 border border-white/20 shadow-2xl shadow-indigo-500/20">
                        <div class="py-12">
                            <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
                                <form method="POST" action="{{ route('docente.taller.store') }}">
                                    @csrf
                                    <div>
                                        <label for="title" class="block text-sm font-medium text-gray-300 mb-2">
                                            Nombre del taller {{$workshop->title ?? ''}}
                                            @error('title')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </label>
                                        <x-text-input id="title" name="title" type="text"
                                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg
                        bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                        transition duration-150 ease-in-out"
                                            required />
                                    </div>

                                    <div class="mt-4">
                                        <label for="description" class="block text-sm font-medium text-gray-300 mb-2">
                                            Descripción
                                        </label>
                                        <textarea id="description" name="description" rows="4"
                                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg
                        bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                        transition duration-150 ease-in-out"></textarea>
                                    </div>

                                    <div class="mt-4">
                                        <label for="max_points" class="block text-sm font-medium text-gray-300 mb-2">
                                            Puntuación máxima
                                        </label>
                                        <x-text-input id="max_points" name="max_points" type="number"
                                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg
                        bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                        transition duration-150 ease-in-out"
                                            value="100" required />
                                    </div>

                                    <div class="mt-6 flex items-center justify-end gap-2">
                                        <a href="{{ route('dashboard') }}" class="underline text-sm">Cancelar</a>
                                        <x-primary-button>Crear</x-primary-button>
                                    </div>
                                </form>
                            </div>
                        </div>
    </x-app-layout>
