@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-black text-white">

  {{-- Hero centrado con brillo --}}
  <div class="relative py-20 text-center">
    <h1 class="text-5xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-pink-400 via-purple-400 to-indigo-400 animate-pulse">
      Mis cursos
    </h1>
    <p class="mt-2 text-lg text-gray-300">
      Explorá las asignaturas en las que estás inscrito
    </p>
  </div>

  {{-- Tarjetas glass con brillo --}}
  <div class="max-w-5xl mx-auto px-6 pb-20 grid gap-6 md:grid-cols-2 lg:grid-cols-3">

    @forelse($cursos as $curso)
      <div class="group relative bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-lg hover:shadow-2xl hover:shadow-indigo-500/30 transition-all duration-300 hover:-translate-y-1">
        <div class="flex items-center gap-4 mb-4">
          <i class="bi bi-book text-3xl text-indigo-400 group-hover:scale-110 transition-transform"></i>
          <div>
            <h5 class="text-xl font-bold text-white">{{ $curso->nombre }}</h5>
            <p class="text-sm text-gray-300">
              Docente: <span class="font-semibold">{{ $curso->docente->name }}</span>
            </p>
          </div>
        </div>
        <a href="{{ route('alumno.cursos.show', $curso) }}"
           class="block w-full text-center bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-purple-500/50">
          Entrar
        </a>
      </div>
    @empty
      {{-- Mensaje vacío con brillo --}}
      <div class="md:col-span-2 lg:col-span-3 text-center py-12">
        <i class="bi bi-inbox text-6xl text-indigo-400"></i>
        <p class="mt-4 text-lg text-gray-300">Aún no estás inscrito en ningún curso.</p>
        <p class="text-sm text-gray-400">Cuando te inscribas en uno aparecerá aquí.</p>
      </div>
    @endforelse

  </div>
</div>
@endsection
