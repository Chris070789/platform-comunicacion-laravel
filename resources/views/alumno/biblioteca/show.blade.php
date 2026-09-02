<x-app-layout>

    @section('content')
        <div class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-black text-white">

            {{-- Hero centrado con brillo --}}
            <div class="relative py-20 text-center">
                <h1
                    class="text-5xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-pink-400 via-purple-400 to-indigo-400 animate-pulse">
                    Biblioteca
                </h1>
                <p class="mt-2 text-lg text-gray-300">
                    Accedé a videos, podcasts, infografías y más
                </p>
            </div>

            {{-- Contenido centrado con glass --}}
            <div class="flex-grow max-w-5xl mx-auto px-6 pb-20">
                <div
                    class="bg-white/10 backdrop-blur-md rounded-2xl p-8 border border-white/20 shadow-2xl shadow-indigo-500/20">

                    {{-- Título y tipo --}}
                    <div class="flex items-center gap-4 mb-6">
                        <i class="bi bi-book text-4xl text-indigo-400"></i>
                        <div>
                            <h2 class="text-2xl font-bold text-white">{{ $biblioteca->titulo }}</h2>
                            <p class="text-sm text-gray-300">Tipo: <span
                                    class="font-semibold">{{ ucfirst($biblioteca->tipo) }}</span></p>
                        </div>
                    </div>

                    {{-- Descripción --}}
                    @if ($biblioteca->descripcion)
                        <p class="text-gray-300 mb-6">{{ $biblioteca->descripcion }}</p>
                    @endif

                    {{-- Contenido según tipo --}}
                    @if ($biblioteca->tipo === 'video')
                        <div class="mb-6">
                            <p class="text-gray-300 mb-2">Video:</p>
                            <a href="{{ $biblioteca->url }}" target="_blank"
                                class="text-indigo-400 hover:text-indigo-300 transition">
                                Ver video
                            </a>
                        </div>
                    @elseif($biblioteca->tipo === 'audio')
                        <div class="mb-6">
                            <p class="text-gray-300 mb-2">Audio:</p>
                            <a href="{{ $biblioteca->url }}" target="_blank"
                                class="text-indigo-400 hover:text-indigo-300 transition">
                                Escuchar audio
                            </a>
                        </div>
                    @elseif($biblioteca->tipo === 'imagen')
                        <div class="mb-6">
                            <p class="text-gray-300 mb-2">Imagen:</p>
                            <img src="{{ Storage::url($biblioteca->archivo) }}" alt="Imagen"
                                class="w-full rounded-lg shadow-lg">
                        </div>
                    @elseif($biblioteca->tipo === 'pdf')
                        <div class="mb-6">
                            <p class="text-gray-300 mb-2">PDF:</p>
                            <a href="{{ Storage::url($biblioteca->archivo) }}" target="_blank"
                                class="text-indigo-400 hover:text-indigo-300 transition">
                                Descargar PDF
                            </a>
                        </div>
                    @elseif($biblioteca->tipo === 'enlace')
                        <div class="mb-6">
                            <p class="text-gray-300 mb-2">Enlace:</p>
                            <a href="{{ $biblioteca->url }}" target="_blank"
                                class="text-indigo-400 hover:text-indigo-300 transition">
                                Abrir enlace
                            </a>
                        </div>
                    @endif

                    {{-- Botón Volver --}}
                    <a href="{{ route('alumno.biblioteca.index') }}"
                        class="block w-full text-center bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-purple-500/50">
                        <i class="bi bi-arrow-left mr-2"></i>Volver a la biblioteca
                    </a>
                </div>
            </div>
        </div>
    @endsection>
</x-app-layout>
