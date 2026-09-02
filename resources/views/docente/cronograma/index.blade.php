<x-app-layout>

    @section('content')
        <div class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-black text-white">
            <x-slot name="header" class="p-0"></x-slot>
            {{-- Hero centrado con brillo --}}
            <div class="relative py-10 text-center">
                <h1
                    class="text-5xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-pink-400 via-purple-400 to-indigo-400 animate-pulse">
                    Cronograma
                </h1>
                <p class="mt-2 text-lg text-gray-300">
                    Administrá hitos y fechas de tu asignatura
                </p>
            </div>

            {{-- Botón NUEVO con brillo --}}
            <div class="max-w-5xl mx-auto px-6 mb-10 flex justify-between items-center">
                <p class="text-gray-300">Lista de hitos</p>
                <a href="{{ route('docente.cronograma.create') }}"
                    class="px-6 py-2 bg-gradient-to-r from-purple-500 to-pink-600 hover:from-purple-600 hover:to-pink-700 text-white rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-purple-500/50">
                    ➕ Agregar hito
                </a>
            </div>

            {{-- Tabla glass con brillo --}}
            <div class="max-w-5xl mx-auto px-6 pb-20">
                <div
                    class="bg-white/10 backdrop-blur-md rounded-2xl p-8 border border-white/20 shadow-2xl shadow-purple-500/20">

                    @if ($cronogramas->isEmpty())
                        <div class="text-center py-12">
                            <i class="bi bi-calendar text-6xl text-purple-400"></i>
                            <p class="mt-4 text-lg text-gray-300">Aún no has registrado hitos.</p>
                            <p class="text-sm text-gray-400">Agregá el primero y aparecerá aquí.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-white/20">
                                <thead>
                                    <tr class="bg-white/5">
                                        <th class="px-6 py-3 text-left text-sm font-semibold text-white">Hito</th>
                                        <th class="px-6 py-3 text-left text-sm font-semibold text-white">Inicio</th>
                                        <th class="px-6 py-3 text-left text-sm font-semibold text-white">Fin</th>
                                        <th class="px-6 py-3 text-center text-sm font-semibold text-white">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-white/10">
                                    @foreach ($cronogramas as $cron)
                                        <tr class="hover:bg-white/10 rounded-lg transition">
                                            <td class="px-6 py-4 text-white font-medium">{{ $cron->titulo }}</td>
                                            <td class="px-6 py-4 text-gray-300">{{ $cron->inicio->format('d/m/Y') }}</td>
                                            <td class="px-6 py-4 text-gray-300">
                                                {{ $cron->fin?->format('d/m/Y') ?? 'Sin fin' }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <a href="{{ route('docente.cronograma.edit', $cron) }}"
                                                    class="text-blue-400 hover:text-blue-300 transition">
                                                    Editar
                                                </a>
                                                <form action="{{ route('docente.cronograma.destroy', $cron) }}"
                                                    method="POST" class="inline">
                                                    @csrf @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-400 hover:text-red-300 transition ml-4"
                                                        onclick="return confirm('¿Eliminar este hito?')">
                                                        Eliminar
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
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
