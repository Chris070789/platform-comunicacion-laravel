@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100">

        {{-- HERO BANNER --}}
        <div class="bg-gradient-to-br from-indigo-600 to-purple-700 px-6 py-12">
            <div class="max-w-5xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight">
                    Bienvenido, {{ Auth::user()->name }}
                </h1>
                <p class="mt-2 text-lg opacity-90">
                    Panel de <span
                        class="px-2 py-0.5 rounded-full bg-white/20">{{ ucfirst(Auth::user()->roles->first()->name) }}</span>
                </p>
            </div>
        </div>

        {{-- ROLE CARDS --}}
        <div class="max-w-6xl mx-auto px-6 py-10 grid gap-6 md:grid-cols-2 lg:grid-cols-3">

            {{-- ALUMNO --}}
            @role('alumno')
                <a href="{{ route('alumno.cursos.index') }}"
                    class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-purple-700 to-indigo-800
          p-6 shadow-lg hover:shadow-xl hover:shadow-purple-500/30
          transform hover:-translate-y-1 transition-all duration-300">
                    <div
                        class="px-6 py-2 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-purple-500/50">
                        <i class="bi bi-plus-circle mr-2"></i>
                        <div>
                            <h3 class="text-xl font-bold text-white">Mis cursos</h3>
                            <p class="text-sm text-gray-400">Consulta los cursos en los que estás inscrito</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('alumno.biblioteca.index') }}"
                    class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-purple-700 to-indigo-800
          p-6 shadow-lg hover:shadow-xl hover:shadow-purple-500/30
          transform hover:-translate-y-1 transition-all duration-300">
                    <div
                        class="px-6 py-2 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-purple-500/50">
                        <i class="bi bi-plus-circle mr-2"></i>
                        <div>
                            <h3 class="text-xl font-bold text-white">Biblioteca</h3>
                            <p class="text-sm text-gray-300">Accedé a videos, podcasts, infografías y más</p>
                        </div>
                    </div>
                </a>

                {{-- Progreso global --}}
                <div class="mb-6">
                    <a href="{{ route('dashboard') }}"></a>
                    <div
                        class="md:col-span-2 bg-white dark:bg-gray-800 p-6 rounded-lg shadow border border-gray-200 dark:border-gray-700">
                        <h2 class="text-xl font-bold">Progreso Global</h2>
                        <div class="progress">
                            <div class="progress-bar bg-indigo-500" role="progressbar" style="width: {{ $progress }}%;"
                                aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
                                {{ round($progress) }}%
                            </div>
                        </div>
                        <p>Etapas completadas: {{ $completedStages }} de {{ $totalStages }}</p>
                    </div>
                </div>

                {{-- Listado de etapas --}}
                <div class="mb-4">
                    <h3 class="text-lg font-semibold mt-8">Etapas</h3>
                    @foreach ($stages as $stage)
                        <div class="mb-4 p-4 border rounded">
                            <h4>{{ $stage->name }}</h4>
                            <p>{{ $stage->description }}</p>
                            <a href="{{ route('dashboard.stage', $stage->id) }}" class="text-indigo-500 hover:underline">
                                Ver progreso
                            </a>
                        </div>
                    @endforeach
                </div>
            @endrole

            {{-- DOCENTE --}}
            @role('docente')
                <a href="{{ route('docente.cursos') }}"
                    class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-purple-700 to-indigo-800
          p-6 shadow-lg hover:shadow-xl hover:shadow-purple-500/30
          transform hover:-translate-y-1 transition-all duration-300">
                    <div
                        class="px-6 py-2 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-purple-500/50">
                        <i class="bi bi-plus-circle mr-2"></i>
                        <div>
                            <h3 class="text-xl font-bold text-white">Cursos que imparto</h3>
                            <p class="text-sm text-gray-400">Gestiona tus asignaturas</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('docente.alumnos') }}"
                    class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-purple-700 to-indigo-800
          p-6 shadow-lg hover:shadow-xl hover:shadow-purple-500/30
          transform hover:-translate-y-1 transition-all duration-300">
                    <div
                        class="px-6 py-2 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-purple-500/50">
                        <i class="bi bi-plus-circle mr-2"></i>
                        <div>
                            <h3 class="text-xl font-bold text-white">Listado de alumnos</h3>
                            <p class="text-sm text-gray-400">Visualiza alumnos por curso</p>
                        </div>
                    </div>
                </a>

                {{-- Big CTA --}}
                <a href="{{ route('docente.curso.gestion') }}"
                    class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-purple-700 to-indigo-800
          p-6 shadow-lg hover:shadow-xl hover:shadow-purple-500/30
          transform hover:-translate-y-1 transition-all duration-300">
                    <div
                        class="px-6 py-2 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-purple-500/50">
                        <i class="bi bi-plus-circle mr-2"></i>
                        <div>
                            <h3 class="text-xl font-bold text-white">Gestionar mi curso</h3>
                            {{-- Subtítulo descriptivo --}}
                            <p class="text-sm text-gray-300 mt-1">Accede a unidades, temas y cronograma</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('docente.biblioteca.index') }}"
                    class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-purple-700 to-indigo-800
          p-6 shadow-lg hover:shadow-xl hover:shadow-purple-500/30
          transform hover:-translate-y-1 transition-all duration-300">
                    <div
                        class="px-6 py-2 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-purple-500/50">
                        <i class="bi bi-plus-circle mr-2"></i>
                        <div>
                            <h3 class="text-xl font-bold text-white">Biblioteca</h3>
                            <p class="text-sm text-gray-300">Compartí videos, podcasts, infografías y más</p>
                        </div>
                    </div>
                </a>

                {{-- Mis Talleres --}}
                <a href="{{ route('docente.taller.index') }}"
                    class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-emerald-700 to-teal-800
          p-6 shadow-lg hover:shadow-xl hover:shadow-emerald-500/30
          transform hover:-translate-y-1 transition-all duration-300">
                    <div
                        class="px-6 py-2 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-purple-500/50">
                        <i class="bi bi-plus-circle mr-2"></i>
                        <div>
                            <h3 class="text-xl font-bold text-white">Mis Talleres</h3>
                            <p class="text-sm text-gray-300">Crea y gestiona ejercicios para tus alumnos</p>
                        </div>
                    </div>
                </a>
            @endrole

            {{-- ADMIN --}}
            @role('admin')
                <a href="{{ route('admin.usuarios') }}"
                    class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-purple-700 to-indigo-800
          p-6 shadow-lg hover:shadow-xl hover:shadow-purple-500/30
          transform hover:-translate-y-1 transition-all duration-300">
                    <div
                        class="px-6 py-2 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-purple-500/50">
                        <i class="bi bi-plus-circle mr-2"></i>
                        <div>
                            <h3 class="text-lg font-bold  dark:text-white">Administrar usuarios</h3>
                            <p class="text-sm text-purple-100 mt-1">Crear, editar y asignar roles</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('admin.cursos.index') }}"
                    class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-purple-700 to-indigo-800
          p-6 shadow-lg hover:shadow-xl hover:shadow-purple-500/30
          transform hover:-translate-y-1 transition-all duration-300">
                    <div
                        class="px-6 py-2 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-purple-500/50">
                        <i class="bi bi-plus-circle mr-2"></i>
                        <div>
                            <h3 class="text-lg font-bold text-white">Administrar cursos</h3>
                            <p class="text-sm text-cyan-100 mt-1">Unidades, temarios y profesores</p>
                        </div>
                    </div>
                </a>
            @endrole

        </div>
    </div>
    <script>
        // Aquí podrías agregar JavaScript para animar la barra de progreso o el porcentajeconst total = {{ $totalStages }};
        const answered = {{ $completedStages }};
        let chart;

        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('progressChart').getContext('2d');
            chart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: [answered, total - answered],
                        backgroundColor: ['#6366f1', '#374151'],
                        borderWidth: 0,
                        cutout: '85%'
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        tooltip: {
                            enabled: false
                        }
                    }
                }
            });
        });
    </script>
@endsection
