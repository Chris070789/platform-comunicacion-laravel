<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Listado de alumnos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100 dark:border-gray-700">

                @if ($alumnos->isEmpty())
                    <!-- Estado vacío estilizado -->
                    <div class="p-12 text-center">
                        <div
                            class="inline-flex p-4 rounded-full bg-purple-50 dark:bg-purple-900/20 text-purple-500 mb-4">
                            <i class="bi bi-people text-3xl"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-1">Sin alumnos matriculados
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Actualmente no hay alumnos inscritos en tus
                            asignaturas.</p>
                    </div>
                @else
                    <!-- Tabla Moderna -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr
                                    class="bg-gray-50 dark:bg-gray-700/50 border-b border-gray-100 dark:border-gray-700">
                                    <th
                                        class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        Alumno</th>
                                    <th
                                        class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        Contacto</th>
                                    <th
                                        class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 w-1/3">
                                        Progreso General</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700/60">
                                @foreach ($alumnos as $alumno)
                                    @php
                                        $progreso = $alumno->getProgressInStage(1);
                                    @endphp
                                    <tr
                                        class="hover:bg-gray-50/80 dark:hover:bg-gray-700/30 transition-colors duration-150">
                                        <!-- Info Alumno e Imagen -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="h-10 w-10 rounded-full bg-gradient-to-br from-purple-500 to-indigo-600 flex items-center justify-center dark:text-white font-bold text-sm shadow-sm">
                                                    {{ strtoupper(substr($alumno->name, 0, 2)) }}
                                                </div>
                                                <div>
                                                    <span
                                                        class="block font-medium text-gray-950 dark:text-white">{{ $alumno->name }}</span>
                                                    <span class="block text-xs text-gray-400 dark:text-gray-500">ID:
                                                        #{{ $alumno->id }}</span>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Email -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="text-sm text-gray-600 dark:text-gray-300 flex items-center gap-1.5">
                                                <i class="bi bi-envelope text-gray-400"></i>
                                                {{ $alumno->email }}
                                            </span>
                                        </td>

                                        <!-- Barra de Progreso Visual -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-full bg-gray-200 dark:bg-gray-700 h-2 rounded-full overflow-hidden">
                                                    <div class="bg-gradient-to-r from-pink-500 to-purple-600 h-full rounded-full transition-all duration-500"
                                                        style="width: {{ $progreso }}%"></div>
                                                </div>
                                                <span
                                                    class="text-sm font-semibold text-gray-700 dark:text-gray-300 min-w-[40px] text-right">
                                                    {{ $progreso }}%
                                                </span>
                                            </div>
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
</x-app-layout>
