@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8 max-w-5xl">

        {{-- Navegación (Breadcrumbs) --}}
        <nav class="flex mb-6 text-sm text-gray-500 dark:text-gray-400">
            <a href="{{ route('forums.index') }}" class="hover:text-blue-600 transition">Foros</a>
            <span class="mx-2">/</span>
            <span class="font-semibold text-gray-800 dark:text-gray-200">{{ $forum->title }}</span>
        </nav>

        {{-- Encabezado del Foro - Versión Dark Modern --}}
        <div
            class="bg-gradient-to-r from-violet-600 to-fuchsia-700 rounded-3xl p-8 mb-8 dark:text-white shadow-xl border border-gray-700">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                <div class="max-w-2xl">
                    <h1 class="text-4xl font-black mb-2 tracking-tight dark:text-white">
                        {{ $forum->title }}
                    </h1>
                    {{-- Cambié text-blue-100 por text-gray-300 para que combine con el fondo gris --}}
                    <p class="text-gray-300 leading-relaxed dark:text-gray-400 text-lg">
                        {{ $forum->description ?? 'Bienvenido a este espacio de discusión y aprendizaje.' }}
                    </p>
                </div>

                @can('create', App\Models\Topic::class)
                    {{-- Botón ajustado a tonos grises/blancos para armonía total --}}
                    <a href="{{ route('forums.topics.create', $forum) }}"
                        class="bg-white text-gray-900 hover:bg-gray-200 px-6 py-3 rounded-2xl font-bold transition-all transform hover:scale-105 shadow-md flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Nuevo Tema
                    </a>
                @endcan
            </div>
        </div>

        {{-- Listado de Temas --}}
        <div
            class="bg-white dark:bg-gray-800 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
            <div class="p-6 border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50">
                <h3 class="text-xl font-bold text-gray-800 dark:text-white">Temas en discusión</h3>
            </div>

            <div class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse ($forum->topics as $topic)
                    <div class="p-6 hover:bg-blue-50/30 dark:hover:bg-blue-900/10 transition-colors group">
                        <div class="flex items-center justify-between gap-4">
                            <div class="flex items-start gap-4">
                                {{-- Icono de Tema --}}
                                <div
                                    class="hidden sm:flex w-12 h-12 rounded-2xl bg-blue-100 dark:bg-blue-900/40 items-center justify-center text-blue-600 dark:text-blue-400">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z">
                                        </path>
                                    </svg>
                                </div>

                                <div>
                                    <a href="{{ route('forums.topics.show', [$forum, $topic]) }}"
                                        class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-blue-600 transition-colors">
                                        {{ $topic->title }}
                                    </a>
                                    <div class="flex items-center gap-3 mt-1 text-sm text-gray-500 dark:text-gray-400">
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                </path>
                                            </svg>
                                            {{ $topic->user->name ?? 'Usuario' }}
                                        </span>
                                        <span>•</span>
                                        <span>{{ $topic->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Acción rápida --}}
                            <div class="flex-shrink-0">
                                <a href="{{ route('forums.topics.show', [$forum, $topic]) }}"
                                    class="text-gray-400 group-hover:text-blue-600 transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-20 text-center text-gray-500 dark:text-gray-400 font-medium">
                        <p>Aún no se han creado temas en este foro. ¡Anímate a empezar la conversación!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
