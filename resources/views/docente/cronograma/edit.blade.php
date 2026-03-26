@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-black text-white">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7">
                <div class="card shadow-sm border-0">
                    <div class="relative py-20 text-center">
                        <div
                            class="text-5xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-pink-400 via-purple-400 to-indigo-400 animate-pulse">
                            <h3 class="mb-0">
                                Editar hito del curso: {{ $cronograma->curso->nombre }}
                            </h3>
                        </div>

                        {{-- Formulario glass con brillo --}}
                        <div class="max-w-3xl mx-auto px-6 pb-20">
                            <div
                                class="bg-white/10 backdrop-blur-md rounded-2xl p-8 border border-white/20 shadow-2xl shadow-indigo-500/20">

                                <div class="card-body">
                                    <form action="{{ route('docente.cronograma.update', $cronograma) }}" method="POST">

                                        @csrf @method('PUT')

                                        {{-- Título --}}
                                        <div class="mb-3">
                                            <label for="titulo" class="form-label fw-bold dark:text-gray-300">Título del
                                                hito</label>
                                            <input type="text" name="titulo" id="titulo"
                                                class="form-control text-gray-900 @error('titulo') is-invalid @enderror "
                                                value="{{ old('titulo', $cronograma->titulo) }}"
                                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            @error('titulo')
                                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        {{-- Fecha inicio --}}
                                        <div class="mb-4">
                                            <label for="inicio"
                                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                Fecha de inicio
                                            </label>
                                            <input id="inicio" name="inicio" type="date"
                                                value="{{ old('inicio', $cronograma->inicio->format('Y-m-d')) }}"
                                                class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            @error('inicio')
                                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        {{-- Fecha fin --}}
                                        <div class="mb-6">
                                            <label for="fin"
                                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                Fecha de fin
                                            </label>
                                            <input id="fin" name="fin" type="date"
                                                value="{{ old('fin', $cronograma->fin->format('Y-m-d')) }}"
                                                class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            @error('fin')
                                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        {{-- Botones --}}
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('docente.cronograma.index') }}"
                                                class="text-red-600 hover:underline text-sm ml-4">
                                                Cancelar
                                            </a>
                                            <button type="submit" class="text-green-600 hover:underline text-sm"
                                                onclick="return confirm('¿Guardar cambios?')">
                                                Guardar cambios
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SweetAlert2 (opcional) --}}
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    document.querySelector('form').addEventListener('submit', function(e) {
                        e.preventDefault();
                        Swal.fire({
                            title: '¿Guardar cambios?',
                            text: "Se actualizará el tema.",
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#0d6efd',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'Sí, guardar',
                            cancelButtonText: 'Cancelar'
                        }).then(result => {
                            if (result.isConfirmed) this.submit();
                        });
                    });
                </script>
            @endsection
