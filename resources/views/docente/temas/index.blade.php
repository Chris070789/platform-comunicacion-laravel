@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-12">
        <div class="max-w-5xl mx-auto px-4">

            {{-- Header --}}
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl shadow-lg p-6 mb-8 text-white">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div>
                        <h2 class="text-2xl font-bold flex items-center gap-3">
                            <i class="bi bi-folder2-open"></i>
                            Temas de la unidad: {{ $unidad->titulo }}
                        </h2>
                        <p class="text-sm opacity-90 mt-1">
                            {{ $temas->count() }} tema{{ $temas->count() === 1 ? '' : 's' }}
                        </p>
                    </div>
                    <a href="{{ route('docente.unidades.temas.create', $unidad) }}"
                        class="bg-white text-indigo-600 px-4 py-2 rounded-lg font-semibold hover:bg-gray-100 transition">
                        <i class="bi bi-plus-circle mr-2"></i>Nuevo tema
                    </a>
                </div>
            </div>

            {{-- Temas --}}
            @forelse($temas as $tema)
                <div
                    class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-5 mb-4 hover:shadow-lg hover:-translate-y-0.5 transition">
                    <div class="flex flex-col sm:flex-row justify-between items-start gap-4">
                        {{-- Info --}}
                        <div>
                            <h5 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                                {{ $tema->titulo }}
                            </h5>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                Orden: <span class="font-medium">{{ $tema->orden }}</span>
                            </p>
                        </div>

                        {{-- Actions --}}

                        <div class="flex gap-2">

                            <a href="{{ route('docente.unidades.temas.edit', [$unidad, $tema]) }}"
                                class="text-green-600 hover:underline text-sm ml-4">
                                Editar
                            </a>

                            <form action="{{ route('docente.unidades.temas.destroy', [$unidad, $tema]) }}" method="POST"
                                class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline text-sm"
                                    onclick="return confirm('¿Eliminar este tema?')">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-gray-800 rounded-xl p-8 text-center">
                    <i class="bi bi-inbox text-5xl text-white mb-4"></i>
                    <h4 class="text-lg font-semibold text-white">
                        Sin temas aún
                    </h4>
                    <p class="text-sm text-gray-300 mt-1">
                        Cuando crees el primero aparecerá aquí.
                    </p>
                </div>
            @endforelse

        </div>
    </div>
@endsection
