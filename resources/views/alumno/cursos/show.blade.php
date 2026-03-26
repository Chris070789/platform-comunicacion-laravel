<x-app-layout>

    @section('content')
        <div class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-black text-white">

            {{-- Hero centrado con brillo --}}
            <div class="relative py-20 text-center">
                <h1
                    class="text-5xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-pink-400 via-purple-400 to-indigo-400 animate-pulse">
                    {{ $curso->nombre }}
                </h1>
                <p class="mt-2 text-lg text-gray-300">
                    Docente: <span class="font-semibold">{{ $curso->docente->name }}</span>
                </p>
            </div>

            {{-- Contenido centrado con glass --}}
            <div class="flex-grow max-w-5xl mx-auto px-6 pb-20">
                <div
                    class="bg-white/10 backdrop-blur-md rounded-2xl p-8 border border-white/20 shadow-2xl shadow-indigo-500/20">

                    {{-- Contenido del curso --}}
                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <i class="bi bi-book text-3xl text-indigo-400"></i>
                            <div>
                                <h2 class="text-2xl font-bold text-white">{{ $curso->nombre }}</h2>
                                <p class="text-sm text-gray-300">Docente: <span
                                        class="font-semibold">{{ $curso->docente->name }}</span></p>
                            </div>
                        </div>

                        {{-- Botón principal --}}
                        <a href="{{ route('alumno.cursos.index') }}"
                            class="block w-full text-center bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-purple-500/50">
                            <i class="bi bi-arrow-left mr-2"></i>Volver a mis cursos
                        </a>
                    </div>

                </div>
            </div>
        </div>
    @endsection>
</x-app-layout>
