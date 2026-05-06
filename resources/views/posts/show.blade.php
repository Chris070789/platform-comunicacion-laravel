@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-10 max-w-3xl">

        {{-- Botón Volver --}}
        <div class="mb-6">
            <a href="{{ url()->previous() }}"
                class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-white flex items-center gap-2 text-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Volver a la discusión
            </a>
        </div>

        {{-- Tarjeta Principal del Post --}}
        <div
            class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl overflow-hidden border border-gray-100 dark:border-gray-700">

            {{-- Cabecera con Autor --}}
            <div
                class="p-6 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center bg-gray-50/50 dark:bg-gray-800/50">
                <div class="flex items-center gap-3">
                    <div
                        class="w-12 h-12 rounded-full bg-gradient-to-tr from-gray-700 to-gray-900 flex items-center justify-center text-white font-bold shadow-md">
                        {{ substr($post->user->name, 0, 1) }}
                    </div>
                    <div>
                        <h1 class="text-lg font-bold text-gray-900 dark:text-white leading-tight">
                            Post de {{ $post->user->name }}
                        </h1>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            Publicado el {{ $post->created_at->format('d M, Y') }}
                        </p>
                    </div>
                </div>

                {{-- Menú de Acciones (Solo si tiene permisos) --}}
                <div class="flex gap-2">
                    @can('update', $post)
                        <a href="{{ route('posts.edit', $post) }}"
                            class="p-2 text-gray-400 hover:text-amber-500 transition-colors" title="Editar">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                        </a>
                    @endcan

                    @can('delete', $post)
                        <form action="{{ route('posts.destroy', $post) }}" method="POST"
                            onsubmit="return confirm('¿Estás seguro de eliminar este post?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-gray-400 hover:text-red-500 transition-colors"
                                title="Eliminar">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                            </button>
                        </form>
                    @endcan
                </div>
            </div>

            {{-- Contenido del Post --}}
            <div class="p-8">
                <div class="prose prose-lg dark:prose-invert max-w-none text-gray-700 dark:text-gray-300 leading-relaxed">
                    {{ $post->content }}
                </div>
            </div>

            {{-- Footer del Post (Opcional) --}}
            <div class="px-8 py-4 bg-gray-50 dark:bg-gray-800/80 border-t border-gray-100 dark:border-gray-700">
                <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 italic">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Plataforma Educativa - Espacio de libre expresión
                </div>
            </div>
        </div>
    </div>
@endsection
