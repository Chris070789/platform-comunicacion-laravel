@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        {{-- Encabezado y Acción Principal --}}
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Foros Educativos</h1>

            @role('docente')
                {{-- Podrías usar un modal aquí, pero por ahora un formulario simplificado --}}
                <form action="{{ route('forums.store') }}" method="POST" class="flex gap-2">
                    @csrf
                    <input type="text" name="title" placeholder="Nuevo tema de foro..."
                        class="rounded-lg border-gray-300 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-200 shadow-md">
                        + Crear Foro
                    </button>
                </form>
            @endrole
        </div>

        {{-- Mensaje para Alumnos --}}
        @role('alumno')
            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6">
                <p class="text-blue-700 text-sm">Explora los foros disponibles y participa en las discusiones de tus clases.</p>
            </div>
        @endrole

        {{-- Listado de Foros --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($forums as $forum)
                <div
                    class="bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md border border-gray-200 dark:border-gray-700 transition p-6 flex flex-col justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4 capitalize">
                            {{ $forum->title }}
                        </h2>
                    </div>

                    <div class="mt-4 flex items-center justify-between border-t pt-4 border-gray-100 dark:border-gray-700">
                        <a href="{{ route('forums.topics.index', $forum->id) }}"
                            class="text-blue-600 hover:text-blue-800 font-medium text-sm flex items-center">
                            Ver discusiones
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </a>

                        {{-- Acciones del Docente --}}
                        @role('docente')
                            <div class="flex gap-2">
                                {{-- Botón Editar (Podría abrir un pequeño toggle) --}}
                                <form action="{{ route('forums.destroy', $forum) }}" method="POST"
                                    onsubmit="return confirm('¿Eliminar este foro?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 p-1">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        @endrole
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500">No hay foros creados por el momento.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
