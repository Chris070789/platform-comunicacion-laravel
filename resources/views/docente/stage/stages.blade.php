<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-center items-center h-full">
            <h1
                class="text-5xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-pink-400 via-purple-400 to-indigo-400 animate-pulse mb-6">
                Ejercicios {{ $taller->name }} {{-- o $taller->title según tu DB --}}
            </h1>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 text-green-600">{{ session('success') }}</div>
            @endif

            <div class="flex justify-between items-center mb-4">
                <button
                    class="rounded-md bg-red-600 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-red-700 focus:shadow-none active:bg-red-700 hover:bg-red-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2"
                    type="button">
                    <a href="{{ route('dashboard') }}">← Volver</a>
                </button>
                <a href="{{ route('docente.stage.create', $workshop) }}"
                    class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                    + Agregar ejercicio
                </a>
            </div>

            <div class="bg-white shadow rounded-lg divide-y">
                @forelse($stages as $stage)
                    <div class="p-4 flex justify-between items-center">
                        <div>
                            <p class="font-medium">{{ $stage->position }}. {{ $stage->name }}</p>
                            <p class="text-sm text-gray-600">{{ $stage->description }}</p>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('docente.stage.edit', $stage) }}"
                                class="text-blue-600 hover:underline text-sm">Editar</a>
                            <form method="POST" action="{{ route('docente.stage.destroy', $stage) }}"
                                onsubmit="return confirm('¿Eliminar ejercicio?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600 hover:underline text-sm">Eliminar</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="p-6 text-gray-500">No hay ejercicios aún.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
