<x-app-layout>
    @section('content')
        <x-slot name="header">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
                Gestionar curso: {{ $curso->nombre }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

                {{-- 1. Materiales --}}
                <section class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">📎 Materiales</h3>
                    @if ($materiales->isEmpty())
                        <p class="text-gray-600 dark:text-gray-400">Aún no has subido materiales.</p>
                    @else
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($materiales as $mat)
                                <li class="py-3 flex justify-between items-center">
                                    <div>
                                        <p class="font-medium text-gray-900 dark:text-gray-100">{{ $mat->titulo }}</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $mat->descripcion }}</p>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        @if ($mat->file_path)
                                            <a href="{{ Storage::url($mat->file_path) }}" target="_blank"
                                                class="text-indigo-600 hover:underline text-sm">
                                                Descargar
                                            </a>
                                        @endif
                                        <a href="{{ route('materiales.edit', $mat) }}"
                                            class="text-blue-600 hover:underline text-sm">
                                            Editar
                                        </a>
                                        <form action="{{ route('materiales.destroy', $mat) }}" method="POST"
                                            class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline text-sm"
                                                onclick="return confirm('¿Eliminar este material?')">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="mt-4">
                        {{-- Botón “Subir nuevo material” --}}
                        <a href="{{ route('materiales.create', $curso) }}"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">
                            Subir nuevo material
                        </a>
                    </div>
                </section>

                {{-- 2. Unidades --}}
                <section class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">📚 Unidades</h3>
                    @if ($unidades->isEmpty())
                        <p class="text-gray-600 dark:text-gray-400">Aún no has creado unidades.</p>
                    @else
                        <ol class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($unidades as $uni)
                                <li class="py-3">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="font-medium text-gray-900 dark:text-gray-100">
                                                {{ $uni->orden }}. {{ $uni->titulo }}
                                            </p>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                                Límite: {{ $uni->fecha_limite ?? 'Sin límite' }}
                                            </p>
                                        </div>
                                        {{-- Botón “Ver temas” --}}
                                        <a href="{{ route('docente.unidades.temas.index', $uni) }}"
                                            class="text-blue-600 hover:underline text-sm ">
                                            Ver temas
                                        </a>
                                        {{-- Botón “Actualizar” --}}
                                        <a href="{{ route('docente.unidades.edit', $uni) }}"
                                            class="text-green-600 hover:underline text-sm ml-4">
                                            Actualizar
                                        </a>
                                        {{-- Botón “Eliminar unidad” --}}
                                        <form action="{{ route('docente.unidades.destroy', $uni) }}" method="POST"
                                            class="text-red-600 hover:underline text-sm ml-4">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:text-red-300 transition ml-4"
                                                onclick="return confirm('¿Eliminar unidad y todo su contenido?')">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ol>
                    @endif
                    <div class="mt-4">
                        <a href="{{ route('docente.unidades.create') }}"
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                            Nueva unidad
                        </a>
                    </div>
                </section>

                {{-- 3. Cronograma --}}
                <section class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">📅 Cronograma</h3>
                    @if ($cronogramas->isEmpty())
                        <p class="text-gray-600 dark:text-gray-400">Aún no has registrado hitos.</p>
                    @else
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($cronogramas as $cron)
                                <li class="py-3 flex justify-between items-center">
                                    <div>
                                        <p class="font-medium text-gray-900 dark:text-gray-100">{{ $cron->titulo }}</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">
                                            {{ $cron->inicio->format('d/m/Y') }} -
                                            {{ $cron->fin?->format('d/m/Y') ?? 'Sin fin' }}
                                        </p>
                                    </div>
                                    <a href="{{ route('docente.cronograma.edit', $cron) }}"
                                        class="text-blue-600 hover:underline text-sm">
                                        Editar
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="mt-4">
                        <a href="{{ route('docente.cronograma.create') }}"
                            class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded">
                            Agregar hito
                        </a>
                    </div>
                </section>

            </div>
        </div>
    @endsection
</x-app-layout>
