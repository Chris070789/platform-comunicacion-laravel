<x-app-layout>

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-black text-white">

  {{-- Hero centrado con brillo --}}
  <div class="relative py-20 text-center">
    <h1 class="text-5xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-pink-400 via-purple-400 to-indigo-400 animate-pulse">
      Mis Unidades
    </h1>
    <p class="mt-2 text-lg text-gray-300">
      Administrá unidades, temas y materiales de tu asignatura
    </p>
  </div>

  {{-- Botón NUEVO con brillo --}}
  <div class="max-w-6xl mx-auto px-6 mb-10 flex justify-between items-center">
    <p class="text-gray-300">Lista de unidades</p>
    <a href="{{ route('docente.unidades.create') }}"
       class="px-6 py-2 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-purple-500/50">
      ➕ Crear unidad
    </a>
  </div>

  {{-- Tabla glass con brillo --}}
  <div class="max-w-6xl mx-auto px-6 pb-20">
    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-8 border border-white/20 shadow-2xl shadow-indigo-500/20">

      @if($unidades->isEmpty())
        <div class="text-center py-12">
          <i class="bi bi-folder text-6xl text-indigo-400"></i>
          <p class="mt-4 text-lg text-gray-300">Aún no hay unidades.</p>
          <p class="text-sm text-gray-400">Creá la primera y aparecerá aquí.</p>
        </div>
      @else
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-white/20">
            <thead>
              <tr class="bg-white/5">
                <th class="px-6 py-3 text-left text-sm font-semibold text-white">#</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-white">Título</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-white">Curso</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-white">Orden</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-white">Fecha límite</th>
                <th class="px-6 py-3 text-center text-sm font-semibold text-white">Acciones</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-white/10">
              @forelse ($unidades as $unidad)
                <tr class="hover:bg-white/10 rounded-lg transition">
                  <td class="px-6 py-4 text-white font-medium">{{ $unidad->id }}</td>
                  <td class="px-6 py-4 text-white">{{ $unidad->titulo }}</td>
                  <td class="px-6 py-4 text-white">{{ $unidad->curso->nombre }}</td>
                  <td class="px-6 py-4 text-white">{{ $unidad->orden }}</td>
                  <td class="px-6 py-4 text-white">{{ $unidad->fecha_limite?->format('d/m/Y') ?? '-' }}</td>
                  <td class="px-6 py-4 text-center">
                    <a href="{{ route('docente.unidades.edit', $unidad) }}"
                       class="text-green-400 hover:text-green-300 transition">
                      Editar
                    </a>
                    <form action="{{ route('docente.unidades.destroy', $unidad) }}" method="POST" class="inline">
                      @csrf @method('DELETE')
                      <button class="text-red-400 hover:text-red-300 transition ml-4"
                              onclick="return confirm('¿Eliminar unidad?')">
                        Borrar
                      </button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="text-center text-gray-400 py-12">
                    <i class="bi bi-folder text-4xl text-gray-400"></i>
                    <p class="mt-2 text-lg text-gray-400">Aún no hay unidades.</p>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      @endif
    </div>
  </div>
</div>
@endsection>
</x-app-layout>
