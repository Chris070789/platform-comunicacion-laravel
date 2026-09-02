@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8 max-w-5xl">

        {{-- Navegación (Breadcrumbs) --}}
        <nav class="flex mb-4 text-sm text-gray-500 dark:text-gray-400" aria-label="Breadcrumb">
            <a href="{{ route('forums.index') }}" class="hover:text-blue-600">Foros</a>
            <span class="mx-2">/</span>
            <span class="font-semibold text-gray-800 dark:text-gray-200">{{ $forum->title }}</span>
        </nav>

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">
                    {{ $forum->title }}
                </h2>
                <p class="text-gray-600 dark:text-gray-400">Participa en las discusiones de este foro.</p>
            </div>

            {{-- Botón para abrir formulario (puedes usar un toggle en JS o dejarlo fijo) --}}
            <div class="w-full md:w-auto">
                <form action="{{ route('forums.topics.store', $forum->id) }}" method="POST"
                    class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 flex gap-2">
                    @csrf
                    <input type="text" name="title" placeholder="¿Qué quieres discutir hoy?"
                        class="flex-1 rounded-lg border-gray-300 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500 text-sm">
                    <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition shadow-sm">
                        Publicar Tema
                    </button>
                </form>
            </div>
        </div>

        {{-- Listado de Temas --}}
        <div class="space-y-4">
            @forelse ($topics as $topic)
                <div
                    class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-5 hover:bg-gray-50 dark:hover:bg-gray-750 transition shadow-sm group">
                    <div class="flex items-center justify-between">
                        <div class="flex items-start gap-4">
                            {{-- Avatar genérico o iniciales --}}
                            <div
                                class="w-10 h-10 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center text-indigo-600 dark:text-indigo-300 font-bold uppercase">
                                {{ substr($topic->user->name, 0, 1) }}
                            </div>

                            <div>
                                <a href="{{ route('topics.posts.index', $topic->id) }}"
                                    class="text-lg font-semibold text-gray-900 dark:text-white group-hover:text-blue-600 transition">
                                    {{ $topic->title }}
                                </a>
                                <div class="flex items-center gap-2 mt-1 text-sm text-gray-500 dark:text-gray-400">
                                    <span
                                        class="font-medium text-gray-700 dark:text-gray-300">{{ $topic->user->name }}</span>
                                    <span>•</span>
                                    <span>{{ $topic->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- Indicador visual de respuestas (opcional si tienes la relación) --}}
                        <div class="hidden sm:flex items-center text-gray-400">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                </path>
                            </svg>
                            <span class="text-xs font-semibold">Ver hilo</span>
                        </div>
                    </div>
                </div>
            @empty
                <div
                    class="text-center py-16 bg-gray-50 dark:bg-gray-800/50 rounded-2xl border-2 border-dashed border-gray-200 dark:border-gray-700">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <p class="mt-4 text-gray-500 dark:text-gray-400 text-lg">Aún no hay temas de discusión. ¡Sé el primero!
                    </p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
