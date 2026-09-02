@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-12">
  <div class="max-w-2xl mx-auto px-4">

    {{-- Header --}}
    <div class="text-center mb-8">
      <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">Subir material</h1>
      <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Completa los campos y selecciona un archivo</p>
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
      <form action="{{ route('materiales.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Curso --}}
        <div class="mb-6">
          <label for="curso_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Curso</label>
          <select name="curso_id" id="curso_id" required
                  class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg
                         bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100
                         focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            <option value="">-- selecciona --</option>
            @foreach(auth()->user()->cursosComoDocente as $c)
              <option value="{{ $c->id }}" {{ old('curso_id')==$c->id ? 'selected' : '' }}>
                {{ $c->nombre }}
              </option>
            @endforeach
          </select>
        </div>

        {{-- Título --}}
        <div class="mb-6">
          <label for="titulo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Título</label>
          <input type="text" id="titulo" name="titulo" value="{{ old('titulo') }}" required
                 class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg
                        bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        {{-- Descripción --}}
        <div class="mb-6">
          <label for="descripcion" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Descripción</label>
          <textarea id="descripcion" name="descripcion" rows="4"
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg
                           bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100
                           focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">{{ old('descripcion') }}</textarea>
        </div>

        {{-- Visible --}}
        <div class="mb-6">
          <label class="inline-flex items-center">
            <input type="checkbox" name="visible" value="1" {{ old('visible') ? 'checked' : '' }}
                   class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Visible para los alumnos</span>
          </label>
        </div>

        {{-- Archivo --}}
        <div class="mb-6">
          <label for="archivo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Archivo</label>
          <div class="flex items-center justify-center w-full"
               x-data="{ fileName: '' }"
               @dragover.prevent @drop.prevent="
                 const dropped = $event.dataTransfer.files[0];
                 $refs.fileInput.files = $event.dataTransfer.files;
                 fileName = dropped.name;">
            <label for="archivo"
                   class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 transition">
              <div class="flex flex-col items-center justify-center pt-5 pb-6">
                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                </svg>
                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                  <span class="font-semibold">Haz clic para subir</span> o arrastra un archivo
                </p>
                <p class="text-xs text-gray-500 dark:text-gray-400" x-text="fileName || 'PDF, DOC, ZIP, hasta 10 MB'"></p>
              </div>
              <input id="archivo" name="archivo" type="file" class="hidden" x-ref="fileInput"
                     @change="fileName = $refs.fileInput.files[0].name">
            </label>
          </div>
        </div>

        {{-- Botones --}}
        <div class="flex items-center justify-end gap-3">
          <a href="{{ url()->previous() }}"
             class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
            Cancelar
          </a>
          <button type="submit"
                  class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition">
            Guardar material
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
