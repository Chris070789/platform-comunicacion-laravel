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

            <div class="flex justify-end">
                <button
                    class="rounded-md bg-red-600 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-red-700 focus:shadow-none active:bg-red-700 hover:bg-red-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2"
                    type="button">
                    <a href="{{ route('docente.taller.stages', $stage->workshop_id) }}">← Cancelar</a>
                </button>

                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded">
                    Actualizar Etapa
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
