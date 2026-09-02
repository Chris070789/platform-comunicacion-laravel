<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
      Editar usuario
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">

          {{-- Mensaje de éxito --}}
          @if (session('success'))
            <div class="mb-4 text-green-600 dark:text-green-400">
              {{ session('success') }}
            </div>
          @endif

          {{-- Formulario --}}
          <form method="POST" action="{{ route('admin.usuarios.update', $user) }}">
            @csrf @method('PUT')

            {{-- Nombre --}}
            <div class="mb-4">
              <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre</label>
              <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required
                     class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
            </div>

            {{-- Email --}}
            <div class="mb-4">
              <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
              <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required
                     class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
            </div>

            {{-- Rol --}}
            <div class="mb-4">
              <label for="rol" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Rol</label>
              <select id="rol" name="rol" required
                      class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
                @foreach($roles as $rol)
                  <option value="{{ $rol->name }}" {{ $user->hasRole($rol->name) ? 'selected' : '' }}>
                    {{ ucfirst($rol->name) }}
                  </option>
                @endforeach
              </select>
            </div>

            {{-- Botones --}}
            <div class="flex items-center justify-end gap-2">
              <a href="{{ route('admin.usuarios') }}"
                 class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">
                Cancelar
              </a>
              <button type="submit"
                      class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">
                Actualizar
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
