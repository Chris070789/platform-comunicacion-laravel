@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-12">
        <div class="max-w-2xl mx-auto px-4">

            {{-- Header --}}
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">Editar material</h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Modifica los campos y guarda los cambios</p>
            </div>

            {{-- Errores --}}
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-lg bg-red-50 dark:bg-red-900 text-red-700 dark:text-red-300 text-sm">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Card --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 sm:p-8">
                <form method="POST" action="{{ route('materiales.update', $material) }}" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    {{-- Curso (solo lectura) --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Curso</label>
                        <input type="text" readonly value="{{ $material->curso?->nombre ?? 'Sin curso' }}"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg
                        bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100
                        focus:ring-0">
                        <input type="hidden" name="curso_id" value="{{ $material->curso_id }}">
                    </div>

                    {{-- Título --}}
                    <div class="mb-6">
                        <label for="titulo"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Título</label>
                        <input type="text" id="titulo" name="titulo" required
                            value="{{ old('titulo', $material->titulo) }}"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg
                        bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    {{-- Descripción --}}
                    <div class="mb-6">
                        <label for="descripcion"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Descripción</label>
                        <textarea id="descripcion" name="descripcion" rows="4"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg
                           bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100
                           focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">{{ old('descripcion', $material->descripcion) }}</textarea>
                    </div>

                    {{-- Visible --}}
                    <div class="mb-6">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="visible" value="1"
                                {{ old('visible', $material->visible) ? 'checked' : '' }}
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Visible para los alumnos</span>
                        </label>
                    </div>

                    {{-- Archivo actual (opcional) --}}
                    <div class="mb-6">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Archivo actual:</p>
                        <a href="{{ Storage::disk('public')->url($material->file_path) }}" target="_blank"
                            class="inline-flex items-center px-3 py-1 rounded bg-indigo-100 dark:bg-indigo-900 text-indigo-700 dark:text-indigo-300">
                            <i class="bi bi-download mr-2"></i> Descargar archivo
                        </a>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Subir solo si deseas cambiarlo:</p>
                        <input type="file" name="archivo"
                            class="mt-2 block w-full text-sm text-gray-600 dark:text-gray-400
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-lg file:border-0
                        file:text-sm file:font-semibold
                        file:bg-indigo-50 file:text-indigo-700
                        hover:file:bg-indigo-100 dark:file:bg-indigo-900 dark:file:text-indigo-300">
                    </div>

                    {{-- Botones --}}
                    <div class="flex items-center justify-end gap-3">
                        <a href="{{ route('materiales.index') }}"
                            class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                            Cancelar
                        </a>
                        <button type="submit"
                            class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition">
                            Actualizar material
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
