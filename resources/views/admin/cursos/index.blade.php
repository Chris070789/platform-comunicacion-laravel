@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-black text-white">

  {{-- Hero centrado con brillo --}}
  <div class="relative py-20 text-center">
    <h1 class="text-5xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-pink-400 via-purple-400 to-indigo-400 animate-pulse">
      Administrar cursos
    </h1>
    <p class="mt-2 text-lg text-gray-300">
      Gestiona docentes y alumnos de cada asignatura
    </p>
  </div>

  {{-- Botón NUEVO con brillo --}}
  <div class="max-w-5xl mx-auto px-6 mb-10 flex justify-between items-center">
    <p class="text-gray-300">Lista de cursos asignados</p>
    <a href="{{ route('admin.cursos.create') }}"
       class="px-6 py-2 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-purple-500/50">
      ➕ Crear nuevo curso
    </a>
  </div>

  {{-- Tabla centrada con color --}}
  <div class="max-w-5xl mx-auto px-6 pb-20">
    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-2xl shadow-indigo-500/20">

      @if($cursos->isEmpty())
        {{-- Mensaje vacío con brillo --}}
        <div class="text-center py-12">
          <i class="bi bi-book text-6xl text-indigo-400"></i>
          <p class="mt-4 text-lg text-gray-300">No hay cursos registrados.</p>
          <p class="text-sm text-gray-400">Cuando crees el primero aparecerá aquí.</p>
        </div>
      @else
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-white/20">
            <thead>
              <tr class="bg-white/5">
                <th class="px-6 py-3 text-left text-sm font-semibold text-white">Curso</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-white">Docente</th>
                <th class="px-6 py-3 text-center text-sm font-semibold text-white">Acciones</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-white/10">
              @foreach($cursos as $curso)
                <tr class="hover:bg-white/10 transition">
                  <td class="px-6 py-4 text-white font-medium">{{ $curso->nombre }}</td>
                  <td class="px-6 py-4 text-gray-300">{{ $curso->docente->name }}</td>
                  <td class="px-6 py-4 text-center">
                    <a href="{{ route('admin.cursos.edit', $curso) }}"
                       class="text-indigo-400 hover:text-indigo-300 transition">
                      Editar
                    </a>
                    <form action="{{ route('admin.cursos.destroy', $curso) }}" method="POST" class="inline">
                      @csrf @method('DELETE')
                      <button type="submit"
                              class="text-red-400 hover:text-red-300 transition ml-4"
                              onclick="return confirm('¿Eliminar curso?')">
                        Eliminar
                      </button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif

    </div>
  </div>
</div>
@endsection
