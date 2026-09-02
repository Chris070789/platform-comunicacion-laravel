@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">

    {{-- Navegación --}}
    <nav class="flex mb-6 text-sm text-gray-500 dark:text-gray-400">
        <a href="{{ route('forums.index') }}" class="hover:text-blue-600">Foros</a>
        <span class="mx-2">/</span>
        <a href="{{ route('forums.topics.index', $topic->forum_id) }}" class="hover:text-blue-600">Temas</a>
        <span class="mx-2">/</span>
        <span class="font-semibold text-gray-800 dark:text-gray-200 truncate">{{ $topic->title }}</span>
    </nav>

    {{-- Cabecera del Tema --}}
    <div class="mb-8 border-b border-gray-200 dark:border-gray-700 pb-6">
        <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white leading-tight">
            {{ $topic->title }}
        </h2>
        <div class="flex items-center gap-3 mt-4">
            <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-white text-xs font-bold">
                {{ substr($topic->user->name, 0, 1) }}
            </div>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Iniciado por <span class="font-semibold text-gray-800 dark:text-gray-200">{{ $topic->user->name }}</span>
                • {{ $topic->created_at->diffForHumans() }}
            </p>
        </div>
    </div>

    {{-- Listado de Posts (Respuestas) --}}
    <div class="space-y-6 mb-10">
        @foreach ($posts as $post)
            <div class="flex gap-4 p-4 rounded-xl transition hover:bg-gray-50 dark:hover:bg-gray-800/50">
                {{-- Avatar --}}
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 rounded-lg bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-300 font-bold">
                        {{ substr($post->user->name, 0, 1) }}
                    </div>
                </div>

                {{-- Contenido del Post --}}
                <div class="flex-1">
                    <div class="flex items-baseline gap-2 mb-1">
                        <span class="font-bold text-gray-900 dark:text-gray-100">{{ $post->user->name }}</span>
                        <span class="text-xs text-gray-500">{{ $post->created_at->format('H:i A') }}</span>
                    </div>
                    <div class="text-gray-700 dark:text-gray-300 leading-relaxed break-words">
                        {{ $post->content }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Área de Respuesta Fija o al Final --}}
    <div class="sticky bottom-6 mt-12">
        <form action="{{ route('topics.posts.store', $topic->id) }}" method="POST" class="bg-white dark:bg-gray-800 p-4 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700">
            @csrf
            <div class="relative">
                <textarea
                    name="content"
                    rows="3"
                    placeholder="Escribe tu respuesta aquí..."
                    class="w-full rounded-xl border-gray-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500 resize-none p-4 pb-12 transition"
                ></textarea>

                <div class="absolute bottom-3 right-3">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-bold text-sm transition-all transform active:scale-95 shadow-lg">
                        Enviar Respuesta
                    </button>
                </div>
            </div>
        </form>
    </div>

</div>
@endsection
