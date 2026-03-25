<x-app-layout>
    @section('content')
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Listado de alumnos') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        @if ($alumnos->isEmpty())
                            <p>No hay alumnos matriculados en tus cursos.</p>
                        @else
                            <ul class="list-disc pl-5">
                                @foreach ($alumnos as $alumno)
                                    <li>{{ $alumno->name }} ({{ $alumno->email }})</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-app-layout>
