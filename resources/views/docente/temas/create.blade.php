@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-12">
  <div class="max-w-2xl mx-auto px-4">

    {{-- Header --}}
    <div class="text-center mb-8">
      <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">
        Nuevo tema
      </h1>
      <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
        Unidad: <span class="font-semibold">{{ $unidad->titulo }}</span>
      </p>
    </div>

    {{-- Card --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 sm:p-8">

      <form method="POST" action="{{ route('docente.unidades.temas.store', $unidad) }}">
        @csrf

        {{-- Título --}}
        <div class="mb-6">
          <label for="titulo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Título
          </label>
          <input type="text" id="titulo" name="titulo" required
                 class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg
                        bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                        transition duration-150 ease-in-out">
        </div>

        {{-- Orden --}}
        <div class="mb-6">
          <label for="orden" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Orden
          </label>
          <input type="number" id="orden" name="orden" min="1" value="1"
                 class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg
                        bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                        transition duration-150 ease-in-out">
        </div>

        {{-- Buttons --}}
        <div class="flex items-center justify-end gap-3">
          <a href="{{ route('docente.unidades.temas.index', $unidad) }}"
             class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
            Cancelar
          </a>
          <button type="submit"
                  class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition">
            Guardar tema
          </button>
        </div>
      </form>

    </div>
  </div>
</div>
@endsection
