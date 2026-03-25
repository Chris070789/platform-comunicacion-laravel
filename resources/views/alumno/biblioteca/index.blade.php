@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-black text-white">

        <h1 class="text-2xl font-bold mb-4">Recursos disponibles</h1>

        @forelse ($biblioteca as $recurso)
            <div class="p-4 mb-2 bg-gradient-to-br rounded shadow">
                <h2 class="text-lg font-semibold">{{ $recurso->titulo }}</h2>
                <p>{{ $recurso->descripcion }}</p>
                <a href="{{ route('alumno.biblioteca.show', $recurso->id) }}" class="text-blue-500 hover:underline">Ver</a>
            </div>
        @empty
            <p>No hay recursos disponibles.</p>
        @endforelse
    </div>
@endsection
