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
                    <p class="text-gray-300 mb-2 font-medium">Reproductor de Video:</p>
                    @if ($biblioteca->archivo)
                    {{-- Video local subido --}}
                    <div class="overflow-hidden rounded-xl bg-black border border-white/10 shadow-lg">
                        <video controls class="w-full max-h-[500px] rounded-xl focus:outline-none">
                            <source src="{{ Storage::url($biblioteca->archivo) }}" type="video/mp4">
                            Tu navegador no soporta el reproductor de video.
                        </video>
                    </div>
                    @elseif ($biblioteca->url)
                    {{-- Video en embebido para YouTube u otros enlaces --}}
                    <div class="relative w-full pt-[56.25%] rounded-xl overflow-hidden bg-black border border-white/10 shadow-lg">
                        <iframe
                            class="absolute top-0 left-0 w-full h-full"
                            src="{{ $biblioteca->embed_url }}"
                            title="{{ $biblioteca->titulo }}"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen>
                        </iframe>
                    </div>
                    @endif
                </div>

                @elseif($biblioteca->tipo === 'audio')
                <div class="mb-6">
                    <p class="text-gray-300 mb-2 font-medium">Reproductor de Audio:</p>
                    @if ($biblioteca->archivo)
                    <div class="p-4 bg-gray-800/60 rounded-xl border border-white/10">
                        <audio controls class="w-full">
                            <source src="{{ Storage::url($biblioteca->archivo) }}" type="audio/mpeg">
                            Tu navegador no soporta el reproductor de audio.
                        </audio>
                    </div>
                    @elseif ($biblioteca->url)
                    <a href="{{ $biblioteca->url }}" target="_blank"
                        class="inline-flex items-center gap-2 text-indigo-400 hover:text-indigo-300 transition">
                        <i class="bi bi-music-note-beaming"></i> Escuchar audio externo
                    </a>
                    @endif
                </div>

                @elseif($biblioteca->tipo === 'imagen')
                <div class="mb-6">
                    <p class="text-gray-300 mb-2 font-medium">Imagen:</p>
                    @if ($biblioteca->archivo)
                    <img src="{{ Storage::url($biblioteca->archivo) }}" alt="{{ $biblioteca->titulo }}"
                        class="w-full max-h-[600px] object-contain rounded-xl shadow-lg border border-white/10">
                    @endif
                </div>

                @elseif($biblioteca->tipo === 'pdf')
                <div class="mb-6">
                    <p class="text-gray-300 mb-2 font-medium">Documento PDF:</p>
                    @if ($biblioteca->archivo)
                    <div class="flex items-center justify-between p-4 bg-gray-800/60 rounded-xl border border-white/10">
                        <div class="flex items-center gap-3">
                            <i class="bi bi-file-earmark-pdf text-red-400 text-3xl"></i>
                            <span class="text-sm font-medium text-gray-200">Visualizar o descargar documento</span>
                        </div>
                        <a href="{{ Storage::url($biblioteca->archivo) }}" target="_blank"
                            class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white rounded-lg transition text-sm font-semibold">
                            Abrir PDF
                        </a>
                    </div>
                    @endif
                </div>

                @elseif($biblioteca->tipo === 'enlace')
                <div class="mb-6">
                    <p class="text-gray-300 mb-2 font-medium">Enlace externo:</p>
                    <a href="{{ $biblioteca->url }}" target="_blank"
                        class="inline-flex items-center gap-2 text-indigo-400 hover:text-indigo-300 transition underline">
                        <i class="bi bi-box-arrow-up-right"></i> {{ $biblioteca->url }}
                    </a>
                </div>
                @endif

                {{-- Botón Volver --}}
                <div class="mt-8">
                    <a href="{{ route('docente.biblioteca.index') }}"
                        class="block w-full py-3 text-center bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-semibold rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-purple-500/50">
                        <i class="bi bi-arrow-left mr-2"></i>Volver a la biblioteca
                    </a>
                </div>

            </div>
        </div>
    </div>
    @endsection
</x-app-layout>