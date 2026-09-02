@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">

    {{-- Encabezado con Estilo de Mensajería --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
        <div>
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white flex items-center gap-3">
                <span class="bg-green-500 w-3 h-3 rounded-full animate-pulse"></span>
                Salas de Chat
            </h2>
            <p class="text-gray-500 dark:text-gray-400">Canales de comunicación en tiempo real.</p>
        </div>

        @role('docente')
        <form id="form-sala" action="{{ route('chat-groups.store') }}" method="POST" class="flex gap-2 w-full md:w-auto">
            @csrf
            <input type="text" name="name" placeholder="Nombre de la sala..." required
                class="flex-1 md:w-64 rounded-xl border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-white focus:ring-green-500 focus:border-green-500 shadow-sm">
            <button type="submit"
                class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-xl font-bold transition shadow-lg flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Nuevo
            </button>
        </form>
        @if(isset($currentGroup))
        <form action="{{ route('chat-groups.destroy', $currentGroup->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar esta sala?');">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-xl font-bold transition shadow-lg flex items-center gap-2 h-full">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                Eliminar
            </button>
        </form>
        @endif
        @endrole
    </div>

    {{-- Alerta para Alumnos (Más discreta) --}}
    @role('alumno')
    <div
        class="mb-8 p-4 bg-green-50 dark:bg-green-900/20 rounded-2xl border border-green-100 dark:border-green-800 flex items-center gap-3">
        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <p class="text-green-800 dark:text-green-300 text-sm italic">Únete a una sala para comenzar a chatear con tus
            compañeros y docentes.</p>
    </div>
    @endrole

    {{-- Listado de Grupos --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        @forelse ($groups as $group)
        <div class="group relative bg-white dark:bg-gray-800 p-5 rounded-2xl border border-gray-200 dark:border-gray-700 hover:border-green-500 dark:hover:border-green-500 hover:shadow-xl transition-all duration-300 flex items-center justify-between gap-4">

            {{-- Enlace para ingresar a la sala --}}
            <a href="{{ route('chat-groups.show', $group->id) }}"
                class="group relative bg-white dark:bg-gray-800 p-5 rounded-2xl border border-gray-200 dark:border-gray-700 hover:border-green-500 dark:hover:border-green-500 hover:shadow-xl transition-all duration-300 flex items-center gap-4">

                {{-- Icono del Grupo --}}
                <div
                    class="w-14 h-14 rounded-2xl bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center text-white shadow-inner">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z">
                        </path>
                    </svg>
                </div>

                <div class="flex-1">
                    <h3
                        class="text-xl font-bold text-gray-800 dark:text-white group-hover:text-green-600 transition-colors">
                        {{ $group->name }}
                    </h3>
                    <div class="flex items-center gap-2 mt-1">
                        <span
                            class="text-xs font-medium text-green-500 bg-green-50 dark:bg-green-900/30 px-2 py-0.5 rounded-full">Activo</span>
                        <span class="text-xs text-gray-400">Click para entrar</span>
                    </div>
                </div>

                <div class="text-gray-300 group-hover:text-green-500 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
            </a>
            {{-- Botón de Borrar (Solo accesible para el rol docente) --}}
            @role('docente')
            <form action="{{ route('chat-groups.destroy', $group->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar la sala «{{ $group->name }}»?');" class="shrink-0 z-10">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-xl transition-colors"
                    title="Eliminar sala">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            </form>
            @endrole
        </div>
        @empty
        <div class="col-span-full py-20 text-center">
            <div
                class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gray-100 dark:bg-gray-800 mb-4">
                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                    </path>
                </svg>
            </div>
            <p class="text-gray-500 dark:text-gray-400 text-lg">No hay grupos de chat disponibles.</p>
        </div>
        @endforelse
    </div>
</div>
<script>
    document.getElementById('form-sala').addEventListener('submit', function(e) {
        const inputName = document.getElementById('name-sala');

        // El método .trim() elimina los espacios vacíos al inicio y al final
        if (inputName.value.trim() === '') {
            e.preventDefault(); // Cancela el envío del formulario
            alert('Por favor, escribe un nombre válido para la sala.');
            inputName.focus();
        }
    });
</script>
@endsection