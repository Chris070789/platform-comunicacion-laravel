@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-black text-white">

  {{-- Hero con brillo --}}
  <div class="relative py-16 text-center">
    <h1 class="text-5xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-pink-400 via-purple-400 to-indigo-400 animate-pulse">
      Administrar usuarios
    </h1>
    <p class="mt-2 text-lg text-gray-300">
      Gestiona roles, edita o elimina cuentas del sistema
    </p>
  </div>

  {{-- Botón NUEVO con brillo --}}
  <div class="max-w-5xl mx-auto px-6 mb-10 flex justify-end">
    <a href="{{ route('admin.usuarios.create') }}"
       class="px-6 py-2 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-purple-500/50">
      <i class="bi bi-plus-circle mr-2"></i>Nuevo usuario
    </a>
  </div>

  {{-- Tabla centrada con color --}}
  <div class="max-w-5xl mx-auto px-6 pb-20">
    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-2xl shadow-indigo-500/20">

      @if($usuarios->isEmpty())
        {{-- Mensaje vacío con brillo --}}
        <div class="text-center py-12">
          <i class="bi bi-people text-6xl text-indigo-400"></i>
          <p class="mt-4 text-lg text-gray-300">No hay usuarios registrados.</p>
          <p class="text-sm text-gray-400">Cuando crees el primero aparecerá aquí.</p>
        </div>
      @else
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-white/20">
            <thead>
              <tr class="bg-white/5">
                <th class="px-6 py-3 text-left text-sm font-semibold text-white">Nombre</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-white">Email</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-white">Rol</th>
                <th class="px-6 py-3 text-center text-sm font-semibold text-white">Acciones</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-white/10">
              @foreach($usuarios as $user)
                <tr class="hover:bg-white/10 transition">
                  <td class="px-6 py-4 text-white font-medium">{{ $user->name }}</td>
                  <td class="px-6 py-4 text-gray-300">{{ $user->email }}</td>
                  <td class="px-6 py-4">
                    @foreach($user->roles as $rol)
                      <span class="inline-block bg-indigo-500/20 text-indigo-300 text-xs px-2 py-1 rounded-full">
                        {{ $rol->name }}
                      </span>
                    @endforeach
                  </td>
                  <td class="px-6 py-4 text-center">
                    <a href="{{ route('admin.usuarios.edit', $user) }}"
                       class="text-indigo-400 hover:text-indigo-300 transition">
                      Editar
                    </a>
                    <form action="{{ route('admin.usuarios.destroy', $user) }}" method="POST" class="inline">
                      @csrf @method('DELETE')
                      <button type="submit"
                              class="text-red-400 hover:text-red-300 transition ml-4"
                              onclick="return confirm('¿Eliminar usuario?')">
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
@endsection
