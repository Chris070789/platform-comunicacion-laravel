@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-black text-white">

  {{-- Hero centrado con brillo --}}
  <div class="relative py-20 text-center">
    <h1 class="text-5xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-pink-400 via-purple-400 to-indigo-400 animate-pulse">
      Editar unidad
    </h1>
    <p class="mt-2 text-lg text-gray-300">
      Modificá título, orden, límite y alumnos de la unidad
    </p>
  </div>

  {{-- Formulario glass con brillo --}}
  <div class="max-w-3xl mx-auto px-6 pb-20">
    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-8 border border-white/20 shadow-2xl shadow-indigo-500/20">

      <form method="POST" action="{{ route('docente.unidades.update', $unidad) }}">
        @csrf @method('PUT')

        {{-- Título --}}
        <div class="mb-6">
          <label for="titulo" class="block text-sm font-medium text-gray-300 mb-2">
            Título de la unidad
          </label>
          <input id="titulo" name="titulo" type="text" required
                 value="{{ old('titulo', $unidad->titulo) }}"
                 class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg
                        bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                        transition duration-150 ease-in-out">
        </div>

        {{-- Orden --}}
        <div class="mb-6">
          <label for="orden" class="block text-sm font-medium text-gray-300 mb-2">
            Orden
          </label>
          <input id="orden" name="orden" type="number" min="1" required
                 value="{{ old('orden', $unidad->orden) }}"
                  class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg
                        bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                        transition duration-150 ease-in-out">
        </div>

        {{-- Fecha límite --}}
        <div class="mb-6">
          <label for="fecha_limite" class="block text-sm font-medium text-gray-300 mb-2">
            Fecha límite (opcional)
          </label>
          <input id="fecha_limite" name="fecha_limite" type="date"
                 value="{{ old('fecha_limite', $unidad->fecha_limite?->format('Y-m-d')) }}"
                  class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg
                        bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                        transition duration-150 ease-in-out">
        </div>

        {{-- Botones con brillo --}}
        <div class="flex items-center justify-end gap-4">
          <a href="{{ route('docente.unidades.index') }}"
             class="px-6 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg transition">
            Cancelar
          </a>
          <button type="submit"
                  class="px-6 py-2 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-purple-500/50">
            Actualizar unidad
          </button>
        </div>
      </form>

    </div>
  </div>
</div>
@endsection
