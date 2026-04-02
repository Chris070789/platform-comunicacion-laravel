<x-app-layout>
    <x-slot name="header">
        <h1
            class="text-5xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-pink-400 via-purple-400 to-indigo-400 animate-pulse">
            Mis Talleres
        </h1>
        <h2 class="mt-2 text-lg dark:text-gray-300">Desarrolla tu taller, y elabora ejercicios interactivos!</h2>
    </x-slot>

    <body class="min-h-screen bg-slate-900 p-8 flex items-center justify-center">
        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

                <button
                    class="rounded-md bg-red-600 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-red-700 focus:shadow-none active:bg-red-700 hover:bg-red-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2"
                    type="button">
                    <a href="{{ route('dashboard') }}">← Volver</a>
                </button>

                <button
                    class="rounded-md bg-green-600 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-green-700 focus:shadow-none active:bg-green-700 hover:bg-green-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2"
                    type="button">
                    <a href="{{ route('docente.taller.create') }}"
                        class="px-4 py-2 bg-blue-600 dark:text-white rounded hover:bg-blue-700">
                        + Nuevo Taller
                    </a>
                </button>

                @if ($talleres->isEmpty())
                    <p class="dark  text-gray-500">No has creado ningún taller aún.</p>
                @else
                    <div class="bg-white shadow rounded-lg divide-y">
                        @foreach ($talleres as $t)
                            <div class="p-4 flex justify-between items-center">
                                <div>
                                    <p class="font-bold">{{ $t->title }}</p>
                                    <p class="text-sm text-gray-600">{{ $t->description }}</p>
                                    <p class="text-xs text-gray-500">{{ $t->alumnos_count }} alumnos</p>
                                </div>
                                <div class="flex gap-2">
                                    <a href="{{ route('docente.taller.stages', $t) }}"
                                        class="text-blue-600 hover:underline text-sm">
                                        Ejercicios
                                    </a>
                                    <a href="{{ route('docente.taller.edit', $t) }}"
                                        class="text-gray-600 hover:underline text-sm">
                                        Editar
                                    </a>
                                    <form action="{{ route('docente.taller.destroy', $t) }}" method="POST"
                                        onsubmit="return confirm('¿Eliminar este taller?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
</x-app-layout>
