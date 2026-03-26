<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
            Nuevo curso
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- Formulario --}}
                <form method="POST" action="{{ route('admin.cursos.store') }}">
                    @csrf

                    {{-- Nombre del curso --}}
                    <div class="mb-4">
                        <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nombre del curso
                        </label>
                        <input id="nombre" name="nombre" type="text" required
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                            placeholder="Ej. Química Avanzada">
                    </div>

                    {{-- Docente --}}
                    <div class="mb-4">
                        <label for="docente_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Asignar a docente
                        </label>
                        <select id="docente_id" name="docente_id" required
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
                            <option value="" disabled selected>-- Elige un docente --</option>
                            @foreach ($docentes as $docente)
                                <option value="{{ $docente->id }}">
                                    {{ $docente->name }} ({{ $docente->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Alumnos -->
                    <div class="mb-3">
                        <label class="form-label">Alumnos</label>
                        <div class="border rounded p-2" style="max-height: 200px; overflow-y: auto;">
                            @foreach ($alumnos as $alumno)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="alumnos[]"
                                        value="{{ $alumno->id }}" id="alumno{{ $alumno->id }}">
                                    <label class="form-check-label" for="alumno{{ $alumno->id }}">
                                        {{ $alumno->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Botones --}}
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('admin.cursos.index') }}"
                            class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">
                            Cancelar
                        </a>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">
                            Crear curso
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
