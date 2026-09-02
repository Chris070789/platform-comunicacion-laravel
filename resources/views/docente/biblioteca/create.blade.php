<x-app-layout>

    @section('content')
        <div class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-black text-white">
            <div class="max-w-2xl mx-auto px-4">

                {{-- Hero centrado con brillo --}}
                <div class="relative py-20 text-center">
                    <h1
                        class="text-5xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-pink-400 via-purple-400 to-indigo-400 animate-pulse">
                        Agregar recurso
                    </h1>
                    
                    <p class="mt-2 text-lg text-gray-300">
                        Compartí videos, podcasts, infografías y más con tus alumnos
                    </p>
                </div>

                {{-- Formulario glass con brillo --}}
                <div class="max-w-3xl mx-auto px-6 pb-20">
                    <div
                        class="bg-white/10 backdrop-blur-md rounded-2xl p-8 border border-white/20 shadow-2xl shadow-indigo-500/20">

                        <form method="POST" action="{{ route('docente.biblioteca.store') }}" enctype="multipart/form-data">
                            @csrf

                            {{-- Título --}}
                            <div class="mb-6">
                                <label for="titulo" class="block text-sm font-medium text-gray-300 mb-2">
                                    Título del recurso
                                </label>
                                <input id="titulo" name="titulo" type="text" required
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg
                        bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                        transition duration-150 ease-in-out">
                            </div>

                            {{-- Descripción --}}
                            <div class="mb-6">
                                <label for="descripcion" class="block text-sm font-medium text-gray-300 mb-2">
                                    Descripción (opcional)
                                </label>
                                <textarea id="descripcion" name="descripcion" rows="3"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg
                        bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                        transition duration-150 ease-in-out"></textarea>
                            </div>

                            {{-- Tipo --}}
                            <div class="mb-6">
                                <label for="tipo" class="block text-sm font-medium text-gray-300 mb-2">
                                    Tipo de recurso
                                </label>
                                <select id="tipo" name="tipo" required
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg
                        bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                        transition duration-150 ease-in-out">
                                    <option value="" disabled selected>-- Elige un tipo --</option>
                                    <option value="video">Video (YouTube, Vimeo, MP4)</option>
                                    <option value="audio">Audio (MP3, Spotify)</option>
                                    <option value="imagen">Imagen (PNG, JPG)</option>
                                    <option value="pdf">PDF</option>
                                    <option value="enlace">Enlace externo</option>
                                </select>
                            </div>

                            {{-- URL --}}
                            <div class="mb-6">
                                <label for="url" class="block text-sm font-medium text-gray-300 mb-2">
                                    URL (YouTube, Spotify, etc.)
                                </label>
                                <input id="url" name="url" type="url"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg
                        bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                        transition duration-150 ease-in-out">
                            </div>

                            {{-- Archivo --}}
                            <div class="mb-6">
                                <label for="archivo" class="block text-sm font-medium text-gray-300 mb-2">
                                    Archivo (MP4, MP3, PNG, JPG, PDF)
                                </label>
                                <input id="archivo" name="archivo" type="file"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg
                        bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                        transition duration-150 ease-in-out">
                            </div>

                            {{-- Botones con brillo --}}
                            <div class="flex items-center justify-end gap-4">
                                <a href="{{ route('docente.biblioteca.index') }}"
                                    class="px-6 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg transition">
                                    Cancelar
                                </a>
                                <button type="submit"
                                    class="px-6 py-2 bg-gradient-to-r from-purple-500 to-pink-600 hover:from-purple-600 hover:to-pink-700 text-white rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-purple-500/50">
                                    Guardar recurso
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        @endsection>
</x-app-layout>
