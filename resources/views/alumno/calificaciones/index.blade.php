<x-app-layout>

    @section('content')
        <div class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-black text-white">

            {{-- Hero centrado con brillo --}}
            <div class="relative py-20 text-center">
                <h1
                    class="text-5xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-pink-400 via-purple-400 to-indigo-400 animate-pulse">
                    Mis calificaciones
                </h1>
                <p class="mt-2 text-lg text-gray-300">
                    Revisá tus notas y avance
                </p>
            </div>

            {{-- Tabla glass con brillo --}}
            <div class="max-w-5xl mx-auto px-6 pb-20">
                <div
                    class="bg-white/10 backdrop-blur-md rounded-2xl p-8 border border-white/20 shadow-2xl shadow-green-500/20">

                    @if ($calificaciones->isEmpty())
                        <div class="text-center py-12">
                            <i class="bi bi-graph-up text-6xl text-green-400"></i>
                            <p class="mt-4 text-lg text-gray-300">Aún no tienes calificaciones.</p>
                            <p class="text-sm text-gray-400">Cuando tus docentes carguen notas aparecerán aquí.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-white/20">
                                <thead>
                                    <tr class="bg-white/5">
                                        <th class="px-6 py-3 text-left text-sm font-semibold text-white">Curso</th>
                                        <th class="px-6 py-3 text-left text-sm font-semibold text-white">Tema</th>
                                        <th class="px-6 py-3 text-left text-sm font-semibold text-white">Nota</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-white/10">
                                    @foreach ($calificaciones as $curso)
                                        @foreach ($curso->temas as $tema)
                                            @if ($tema->calificaciones->where('user_id', Auth::id())->isNotEmpty())
                                                <tr class="hover:bg-white/10 rounded-lg transition">
                                                    <td class="px-6 py-4 text-white font-medium">{{ $curso->nombre }}</td>
                                                    <td class="px-6 py-4 text-gray-300">{{ $tema->titulo }}</td>
                                                    <td class="px-6 py-4 text-gray-300">
                                                        {{ $tema->calificaciones->where('user_id', Auth::id())->first()->nota ?? 'Sin nota' }}
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endsection>
</x-app-layout>
