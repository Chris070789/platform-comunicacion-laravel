@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-black py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center justify-between mb-10">
                <div>
                    <h1
                        class="text-5xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-pink-400 via-purple-400 to-indigo-400 animate-pulse">
                        Recursos disponibles</h1>
                    <p class="mt-2 text-lg text-gray-300">Explora materiales, videos y guías para tu aprendizaje.</p>
                </div>
                <div class="hidden md:block">
                    <i class="bi bi-collection-play text-5xl text-white/20"></i>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($biblioteca as $recurso)
                    <div
                        class="group relative flex flex-col bg-white/5 backdrop-blur-xl rounded-3xl border border-white/10 p-6 hover:bg-white/10 transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl hover:shadow-purple-500/20">

                        <div class="flex items-center justify-between mb-4">
                            <span
                                class="px-3 py-1 text-xs font-semibold bg-purple-500/20 text-white rounded-full border border-purple-500/30">
                                Recurso
                            </span>
                            <i class="bi bi-star text-white/20 group-hover:text-yellow-400 transition-colors"></i>
                        </div>

                        <h2 class="text-xl font-bold text-white group-hover:text-purple-300 transition-colors mb-2">
                            {{ $recurso->titulo }}
                        </h2>

                        <p class="text-gray-400 text-sm leading-relaxed mb-6 flex-grow line-clamp-3">
                            {{ $recurso->descripcion }}
                        </p>

                        <div class="mt-auto">
                            <a href="{{ route('alumno.biblioteca.show', $recurso->id) }}"
                                class="inline-flex items-center justify-center w-full px-6 py-3 text-sm font-bold text-white bg-gradient-to-r from-indigo-600 to-purple-600 rounded-xl hover:from-indigo-500 hover:to-purple-500 transition-all shadow-lg shadow-indigo-500/25 group-hover:scale-[1.02]">
                                Explorar recurso
                                <i class="bi bi-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full flex flex-col items-center justify-center py-20 text-center">
                        <div class="bg-white/5 p-6 rounded-full mb-4">
                            <i class="bi bi-archive text-5xl text-white/20"></i>
                        </div>
                        <p class="text-xl text-white/80">No hay recursos disponibles en este momento.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
