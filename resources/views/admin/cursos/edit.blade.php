@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-black text-white">

        {{-- Hero centrado con brillo --}}
        <div class="relative py-20 text-center">
            <h1
                class="text-5xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-pink-400 via-purple-400 to-indigo-400 animate-pulse">
                Editar curso
            </h1>
            <p class="mt-2 text-lg text-gray-300">
                Modificá docentes, alumnos y datos de la asignatura
            </p>
        </div>

        {{-- Formulario glass con brillo --}}
        <div class="max-w-3xl mx-auto px-6 pb-20">
            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-8 border border-blue/20 shadow-2xl shadow-indigo-500/20">

                <form method="POST" action="{{ route('admin.cursos.update', $curso) }}">
                    @csrf @method('PUT')

                    {{-- Nombre del curso --}}
                    <div class="mb-6">
                        <label for="nombre" class="block text-sm font-medium text-gray-300 mb-2">
                            Nombre del curso
                        </label>
                        <input id="nombre" name="nombre" type="text" required
                            value="{{ old('nombre', $curso->nombre) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
                    </div>

                    {{-- Docente --}}
                    <div class="mb-6">
                        <label for="docente_id" class="block text-sm font-medium text-gray-300 mb-2">
                            Asignar a docente
                        </label>
                        <select id="docente_id" name="docente_id" required
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
                            <option value="" disabled>-- Elige un docente --</option>
                            @foreach ($docentes as $docente)
                                <option value="{{ $docente->id }}"
                                    {{ $docente->id == $curso->docente_id ? 'selected' : '' }}>
                                    {{ $docente->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Alumnos (check-list con scroll) --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-300 mb-2">Alumnos</label>
                        <div class="max-h-48 overflow-y-auto bg-white/10 border border-white/30 rounded-lg p-4 space-y-2">
                            @foreach ($alumnos as $alumno)
                                <label
                                    class="flex items-center gap-3 cursor-pointer hover:bg-white/10 rounded px-2 py-1 transition">
                                    <input type="checkbox" name="alumnos[]" value="{{ $alumno->id }}"
                                        id="alumno{{ $alumno->id }}"
                                        {{ $curso->alumnos->contains($alumno->id) ? 'checked' : '' }}
                                        class="w-4 h-4 text-pink-600 bg-transparent border-white/30 rounded focus:ring-pink-400">
                                    <span class="text-white">{{ $alumno->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Botones con brillo --}}
                    <div class="flex items-center justify-end gap-4">
                        <a href="{{ route('admin.cursos.index') }}"
                            class="px-6 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg transition">
                            Cancelar
                        </a>
                        <button type="submit"
                            class="px-6 py-2 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-purple-500/50">
                            Actualizar curso
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
