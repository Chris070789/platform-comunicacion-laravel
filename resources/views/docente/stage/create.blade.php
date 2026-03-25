<x-app-layout>
    <x-slot name="header">
        <div class="text-center py-8">
            <h1
                class="text-4xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-pink-400 via-purple-400 to-indigo-400">
                Nueva Etapa {{ $workshop->name }}
            </h1>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto mt-10 bg-white dark:bg-gray-800 p-6 rounded-lg shadow">

        <form action="{{ route('docente.stages.store', $workshop) }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Título de la
                    etapa</label>
                <input type="text" name="title" id="title" required
                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            </div>

            <div class="mb-4">
                <label for="description"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descripción</label>
                <textarea name="description" id="description" rows="4"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded">
                    Crear Etapa
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
