@extends('layouts.app')

@section('content')
    <style>
        .min-h-screen {
            min-height: 100vh;
        }

        /* Contenedor principal */
        .badge-container {
            width: 80px;
            transition: transform 0.3s ease;
        }

        .badge-container:hover {
            transform: scale(1.1);
            /* Efecto de zoom al pasar el mouse */
        }

        /* El círculo de la insignia */
        .badge-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 8px;
            font-size: 1.5rem;
            color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        /* Variantes de color */
        .badge-gold {
            background: linear-gradient(135deg, #ffce3a 0%, #f39c12 100%);
            border: 3px solid #f1c40f;
        }

        .badge-purple {
            background: linear-gradient(135deg, #a29bfe 0%, #6c5ce7 100%);
            border: 3px solid #8e44ad;
        }

        .badge-locked {
            background: #e0e0e0;
            border: 3px solid #bdc3c7;
            color: #95a5a6;
        }

        /* Etiqueta de texto debajo */
        .badge-label {
            font-size: 0.75rem;
            font-weight: 600;
            display: block;
            color: #4a4a4a;
        }

        @keyframes shine {
            0% {
                left: -100%;
            }

            100% {
                left: 100%;
            }
        }

        .badge-gold {
            position: relative;
            overflow: hidden;
        }

        .badge-gold::after {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 50%;
            height: 100%;
            background: rgba(255, 255, 255, 0.4);
            transform: skewX(-25deg);
            animation: shine 3s infinite;
        }
    </style>
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
        <div class="max-w-6xl mx-auto px-6 py-10">
            {{-- ROLE CARDS --}}
            <div class="max-w-6xl mx-auto px-6 py-10 grid gap-6 md:grid-cols-2 lg:grid-cols-3">

                {{-- ALUMNO --}}
                @role('alumno')
                    <!-- COLUMNA IZQUIERDA: ACCIONES Y ETAPAS (2/3 del ancho) -->
                    <div class="lg:col-span-2 space-y-8  ">

                        {{-- Botones de Acción Rápida --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <a href="{{ route('alumno.cursos.index') }}"
                                class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-purple-700 to-indigo-800 p-6 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                <div class="relative z-10 flex items-center space-x-4">
                                    <div class="p-3 bg-white/20 rounded-lg text-white">
                                        <i class="bi bi-journal-bookmark-fill text-2xl"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold text-white">Mis cursos</h3>
                                        <p class="text-xs text-purple-100 opacity-80">Cursos en los que estás inscrito</p>
                                    </div>
                                </div>
                                <i
                                    class="bi bi-journal-bookmark-fill absolute -right-4 -bottom-4 text-7xl text-white opacity-10"></i>
                            </a>

                            <a href="{{ route('alumno.biblioteca.index') }}"
                                class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-purple-700 to-indigo-800 p-6 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                <div class="relative z-10 flex items-center space-x-4">
                                    <div class="p-3 bg-white/20 rounded-lg text-white">
                                        <i class="bi bi-collection-play-fill text-2xl"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold text-white">Biblioteca</h3>
                                        <p class="text-xs text-purple-100 opacity-80">Videos, podcasts y más</p>
                                    </div>
                                </div>
                                <i
                                    class="bi bi-collection-play-fill absolute -right-4 -bottom-4 text-7xl text-white opacity-10"></i>
                            </a>
                        </div>

                        {{-- Listado de Etapas --}}
                        <div>
                            <h3 class="text-xl font-bold mb-4 flex items-center">
                                <i class="bi bi-signpost-split mr-2 text-indigo-500"></i> Mi Camino de Aprendizaje
                            </h3>
                            <div class="grid gap-4">
                                @foreach ($stages as $stage)
                                    <div
                                        class="bg-white dark:bg-gray-800 p-5 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm flex items-center justify-between group hover:border-indigo-400 transition-all">
                                        <div>
                                            <h4 class="font-bold text-gray-800 dark:text-gray-100">{{ $stage->name }}</h4>
                                            <p class="text-sm text-gray-500 line-clamp-1">{{ $stage->description }}</p>
                                        </div>
                                        <a href="{{ route('dashboard.stage', $stage->id) }}"
                                            class="p-2 bg-indigo-50 text-indigo-600 rounded-lg group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                                            <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- COLUMNA DERECHA: PROGRESO Y LOGROS (1/3 del ancho) -->
                    <div class="space-y-8">
                        {{-- Card de Progreso con Chart --}}
                        <div
                            class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 text-center">
                            <h3 class="text-lg font-bold mb-4 text-gray-700 dark:text-gray-300">Progreso Global</h3>
                            <div class="relative inline-block w-40 h-40">
                                <canvas id="progressChart"></canvas>
                                <div class="absolute inset-0 flex flex-col items-center justify-center">
                                    <span class="text-3xl font-black text-indigo-600">{{ round($progress) }}%</span>
                                    <span class="text-[10px] uppercase tracking-wider text-gray-400">Completado</span>
                                </div>
                            </div>
                            <p class="mt-4 text-sm text-gray-500 font-medium">
                                {{ $completedStages }} de {{ $totalStages }} etapas superadas
                            </p>
                        </div>

                        {{-- Card de Logros --}}
                            <div
                                class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                                <h5 class="font-bold mb-6 flex items-center justify-center text-gray-800 dark:text-white">
                                    <i class="bi bi-star-fill text-yellow-500 mr-2"></i> Mis Logros
                                </h5>
                                <div class="flex flex-wrap justify-center gap-4">
                                    <div class="badge-container text-center group">
                                        <div class="badge-icon badge-gold group-hover:scale-110">
                                            <i class="bi bi-trophy-fill"></i>
                                        </div>
                                        <span class="badge-label">Top Alumno</span>
                                    </div>

                                    <div class="badge-container text-center group">
                                        <div class="badge-icon badge-purple group-hover:scale-110">
                                            <i class="bi bi-chat-quote-fill"></i>
                                        </div>
                                        <span class="badge-label">Participativo</span>
                                    </div>

                                    <div class="badge-container text-center opacity-30 grayscale group">
                                        <div class="badge-icon badge-locked">
                                            <i class="bi bi-lock-fill"></i>
                                        </div>
                                        <span class="badge-label">Invencible</span>
                                    </div>
                                </div>
                            </div>
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
                                backgroundColor: ['#6366f1', '#e5e7eb'],
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
