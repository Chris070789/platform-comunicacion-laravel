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

        {{-- HERO BANNER INFANTIL Y ANIMADO --}}
        <div
            class="relative overflow-hidden bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 px-6 py-12 rounded-b-[2rem] shadow-lg dark:from-indigo-950 dark:via-purple-900 dark:to-pink-950">

            {{-- Burbujas decorativas de fondo para dar textura de juego --}}
            <div class="absolute -top-10 -left-10 w-40 h-40 bg-white/10 rounded-full blur-xl pointer-events-none"></div>
            <div
                class="absolute -bottom-10 right-10 w-32 h-32 bg-pink-400/20 rounded-full blur-lg pointer-events-none animate-pulse">
            </div>

            <div class="max-w-5xl mx-auto flex flex-col items-center text-center relative z-10">

                {{-- Contenedor del Logo con animación de flotado y fondo brillante --}}
                <div class="relative mb-4 group">
                    <div
                        class="absolute inset-0 bg-white/20 rounded-full blur-md group-hover:blur-xl transition-all duration-300">
                    </div>
                    <img src="{{ asset('images/chacharaLetraIco.ico') }}"
                        class="relative w-28 h-28 object-contain transform hover:scale-110 transition-transform duration-300 drop-shadow-[0_5px_15px_rgba(255,255,255,0.3)]">
                </div>

                {{-- Título principal amigable --}}
                <h1 class="text-4xl md:text-5xl font-black text-white tracking-wide drop-shadow-sm">
                    ¡Hola, {{ explode(' ', Auth::user()->name)[0] }}! 👋✨
                </h1>

                {{-- Rol o Info adaptada con estilo "Badge de videojuego" --}}
                <p class="mt-4 text-lg md:text-xl font-medium text-purple-100 flex items-center gap-2">
                    Estás en el espacio de:
                    <span
                        class="px-4 py-1 rounded-full bg-yellow-400 text-purple-950 font-bold text-sm uppercase tracking-wider shadow-md transform -rotate-1 hover:rotate-0 transition-transform duration-200">
                        🚀 {{ ucfirst(Auth::user()->roles->first()->name ?? 'Invitado') }}
                    </span>
                </p>

                {{-- Pequeña frase de motivación para los niños --}}
                <p class="mt-2 text-sm text-indigo-100/80 italic">
                    ¡Hoy es un gran día para llenar el mundo de palabras divertidas! 🎈
                </p>

            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
            {{-- ALUMNO --}}
            @role('alumno')
                <img src="{{ asset('images/chacharaMensaje.png') }}" class="w-24 h-24 object-contain">
                {{-- COLUMNA IZQUIERDA: ACCIONES Y CAMINO (2/3 del ancho en pantallas grandes) --}}
                <div class="md:col-span-2 space-y-8">
                    {{-- Tarjeta 1: Mis Cursos --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <a href="{{ route('alumno.cursos.index') }}"
                            class="group relative overflow-hidden rounded-3xl bg-gradient-to-br from-indigo-600 via-purple-700 to-purple-800 p-0.5 shadow-md hover:shadow-2xl hover:shadow-purple-500/20 transition-all duration-500 transform hover:-translate-y-1.5 block">

                            <!-- Efecto de brillo rápido al pasar el cursor -->
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000 ease-out">
                            </div>

                            <!-- Contenedor Interno de contenido -->
                            <div
                                class="relative z-10 flex items-center space-x-5 bg-indigo-950/40 backdrop-blur-md rounded-[calc(1.5rem-2px)] p-6">
                                <!-- Imagen tipo Icono/Ilustración -->
                                <div class="shrink-0">
                                    <img src="{{ asset('images/cursoLg.png') }}" alt="Icono Gestionar curso"
                                        class="w-14 h-14 object-contain rounded-2xl bg-white/10 p-2 shadow-inner border border-white/10 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                                </div>

                                <div class="flex-1">
                                    <h3
                                        class="text-xl font-extrabold text-white tracking-tight group-hover:text-pink-200 transition-colors duration-300">
                                        Mis cursos</h3>
                                    <p class="text-sm text-purple-100/80 leading-snug mt-0.5">Gestiona tus clases y material
                                        de estudio</p>
                                </div>
                            </div>

                            <!-- Icono gigante decorativo al fondo -->
                            <i
                                class="bi bi-journal-bookmark-fill absolute -right-4 -bottom-6 text-8xl text-white opacity-[0.03] group-hover:opacity-10 group-hover:-rotate-12 group-hover:scale-110 transition-all duration-700 pointer-events-none"></i>
                        </a>

                        {{-- Tarjeta 2: Biblioteca --}}
                        <a href="{{ route('alumno.biblioteca.index') }}"
                            class="group relative overflow-hidden rounded-3xl bg-gradient-to-br from-indigo-600 via-purple-700 to-purple-800 p-0.5 shadow-md hover:shadow-2xl hover:shadow-purple-500/20 transition-all duration-500 transform hover:-translate-y-1.5 block">

                            <!-- Efecto de brillo rápido al pasar el cursor -->
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000 ease-out">
                            </div>

                            <!-- Contenedor Interno de contenido -->
                            <div
                                class="relative z-10 flex items-center space-x-5 bg-purple-950/40 backdrop-blur-md rounded-[calc(1.5rem-2px)] p-6">
                                <!-- Imagen tipo Icono/Ilustración -->
                                <div class="shrink-0">
                                    <img src="{{ asset('images/bibliotecaLg.png') }}" alt="Icono Biblioteca"
                                        class="w-14 h-14 object-contain rounded-2xl bg-white/10 p-2 shadow-inner border border-white/10 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                                </div>

                                <div class="flex-1">
                                    <h3
                                        class="text-xl font-extrabold text-white tracking-tight group-hover:text-pink-200 transition-colors duration-300">
                                        Biblioteca</h3>
                                    <p class="text-sm text-purple-100/80 leading-snug mt-0.5">Explora recursos multimedia y
                                        guías virtuales</p>
                                </div>
                            </div>

                            <!-- Icono gigante decorativo al fondo -->
                            <i
                                class="bi bi-collection-play-fill absolute -right-4 -bottom-6 text-8xl text-white opacity-[0.03] group-hover:opacity-10 group-hover:-rotate-12 group-hover:scale-110 transition-all duration-700 pointer-events-none"></i>
                        </a>

                    </div>

                    {{-- Listado de Etapas --}}
                    <div class="space-y-4">
                        <div class="relative pb-2 mb-6 border-b border-gray-100 dark:border-gray-800/60">
                            <h3
                                class="text-lg font-extrabold flex items-center gap-3 text-gray-900 dark:text-white tracking-tight">
                                <div
                                    class="p-2 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 text-white shadow-md shadow-indigo-500/20 shrink-0">
                                    <i class="bi bi-signpost-split flex text-base"></i>
                                </div>
                                <div>
                                    <span class="block">Mi Camino de Aprendizaje</span>
                                    <span class="block text-xs font-normal text-gray-400 dark:text-gray-500 mt-0.5">Sigue tu
                                        progreso etapa por etapa</span>
                                </div>
                            </h3>
                        </div>
                        <div class="grid gap-4">
                            @foreach ($stages as $stage)
                                <div
                                    class="bg-white dark:bg-gray-800 p-5 rounded-2xl border border-gray-100 dark:border-gray-700/70 shadow-sm flex items-center justify-between group hover:border-indigo-400 dark:hover:border-indigo-500 hover:shadow-md transition-all duration-300">
                                    <div class="pr-4">
                                        <h4
                                            class="font-bold text-gray-800 dark:text-gray-100 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                            {{ $stage->name }}</h4>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 line-clamp-1 leading-relaxed">
                                            {{ $stage->description }}</p>
                                    </div>
                                    <a href="{{ route('dashboard.stage', $stage->id) }}"
                                        class="p-2 bg-indigo-50 text-indigo-600 rounded-lg group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                                        <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div> {{-- ¡AQUÍ ESTABA EL CIERRE FALTANTE DE LA COLUMNA IZQUIERDA! --}}

                {{-- COLUMNA DERECHA: PROGRESO Y LOGROS (1/3 del ancho en pantallas grandes) --}}
                <div class="md:col-span-1 space-y-8">
                    {{-- Card de Progreso con Chart --}}
                    <div
                        class="bg-white dark:bg-gray-800 p-6 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-700 text-center">
                        <h3 class="text-lg font-bold mb-6 text-gray-700 dark:text-gray-300 tracking-tight">Progreso Global
                        </h3>
                        <div class="relative inline-block w-40 h-40">
                            <canvas id="progressChart"></canvas>
                            <div class="absolute inset-0 flex flex-col items-center justify-center">
                                <span
                                    class="text-3xl font-black text-indigo-600 dark:text-indigo-400">{{ round($progress) }}%</span>
                                <span
                                    class="text-[10px] uppercase tracking-wider font-bold text-gray-400 mt-0.5">Completado</span>
                            </div>
                        </div>
                        <p
                            class="mt-5 text-sm text-gray-500 dark:text-gray-400 font-medium bg-gray-50 dark:bg-gray-700/30 py-2 rounded-xl">
                            {{ $completedStages }} de {{ $totalStages }} etapas superadas
                        </p>
                    </div>

                    {{-- Card de Logros --}}
                    <div
                        class="bg-white dark:bg-gray-800 p-6 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-700">
                        <h5
                            class="font-bold mb-6 flex items-center justify-center text-gray-800 dark:text-white tracking-tight">
                            <i class="bi bi-star-fill text-yellow-500 mr-2"></i> Mis Logros
                        </h5>
                        <div class="flex flex-wrap justify-center gap-4">
                            <!-- Insignia: "Invencible" -->
                            <div
                                class="badge-container text-center group {{ $completedStages == $totalStages ? '' : 'opacity-30 grayscale' }}">
                                <div class="badge-icon {{ $completedStages == $totalStages ? 'badge-gold' : 'badge-locked' }}">
                                    @if ($completedStages == $totalStages)
                                        <i class="bi bi-trophy-fill"></i>
                                    @else
                                        <i class="bi bi-lock-fill"></i>
                                    @endif
                                </div>
                                <span class="badge-label mt-2 block text-xs font-semibold">
                                    {{ $completedStages == $totalStages ? '¡Tarea Completada!' : 'Finaliza la tarea' }}
                                </span>
                            </div>

                            <!-- Insignia por progreso -->
                            <div
                                class="badge-container text-center group {{ $completedStages >= $totalStages / 2 ? '' : 'opacity-30 grayscale' }}">
                                <div
                                    class="badge-icon {{ $completedStages >= $totalStages / 2 ? 'badge-purple' : 'badge-locked' }}">
                                    <i class="bi bi-star-half"></i>
                                </div>
                                <span class="badge-label mt-2 block text-xs font-semibold">
                                    {{ $completedStages >= $totalStages / 2 ? '¡Buen Trabajo!' : 'Mitad del camino' }}
                                </span>
                            </div>
                        </div>

                        @if ($completedStages == $totalStages && $totalStages > 0)
                            <div
                                class="mt-6 p-4 bg-green-50 dark:bg-green-950/30 text-green-700 dark:text-green-400 rounded-2xl text-xs font-bold text-center animate-bounce border border-green-100 dark:border-green-900/30">
                                ¡Increíble! Has completado todos los ejercicios, felicidades. 🏆
                            </div>
                        @endif
                    </div>
                </div>
            @endrole
        </div>
        <div class="max-w-7xl mx-auto px-6 py-10 space-y-6">
            {{-- DOCENTE --}}
            @role('docente')
                {{-- Tu Grid de 3 columnas ahora sí tendrá el 100% del ancho disponible --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 items-stretch">
                    {{-- Botón 1: Cursos --}}
                    <a href="{{ route('docente.cursos') }}"
                        class="group relative inline-block overflow-hidden rounded-2xl bg-gradient-to-br from-purple-700 to-indigo-800
            p-6 shadow-lg hover:shadow-xl hover:shadow-purple-500/30
            transform hover:-translate-y-1 transition-all duration-300 w-fit">
                        <div <!-- Imagen tipo Icono/Ilustración -->
                            <img src="{{ asset('images/cursoIco.ico') }}" alt="Icono Cursos"
                                class="w-12 h-12 object-contain rounded-lg bg-white/10 p-1 group-hover:rotate-6 transition-transform duration-300">
                            <div>
                                <h3 class="text-xl font-bold text-white">Cursos que imparto</h3>
                                <p class="text-sm text-gray-400">Gestiona tus asignaturas</p>
                            </div>
                        </div>
                    </a>
                    {{-- Botón 2: Alumnos --}}
                    <a href="{{ route('docente.alumnos') }}"
                        class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-purple-700 to-indigo-800
          p-6 shadow-lg hover:shadow-xl hover:shadow-purple-500/30
          transform hover:-translate-y-1 transition-all duration-300">
                        <div <!-- Imagen tipo Icono/Ilustración -->
                            <img src="{{ asset('images/alumnoIco.ico') }}" alt="Icono Listado de alumnos"
                                class="w-12 h-12 object-contain rounded-lg bg-white/10 p-1 group-hover:rotate-6 transition-transform duration-300">
                            <div>
                                <h3 class="text-xl font-bold text-white">Listado de alumnos</h3>
                                <p class="text-sm text-gray-400">Visualiza alumnos por curso</p>
                            </div>
                        </div>
                    </a>

                    {{-- Botón 3: Gestión --}}
                    <a href="{{ route('docente.curso.gestion') }}"
                        class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-purple-700 to-indigo-800
          p-6 shadow-lg hover:shadow-xl hover:shadow-purple-500/30
          transform hover:-translate-y-1 transition-all duration-300">
                        <div <!-- Imagen tipo Icono/Ilustración -->
                            <img src="{{ asset('images/gestionIco.ico') }}" alt="Icono Gestionar curso"
                                class="w-12 h-12 object-contain rounded-lg bg-white/10 p-1 group-hover:rotate-6 transition-transform duration-300">
                            <div>
                                <h3 class="text-xl font-bold text-white">Gestionar mi curso</h3>
                                {{-- Subtítulo descriptivo --}}
                                <p class="text-sm text-gray-300 mt-1">Accede a unidades, temas y cronograma</p>
                            </div>
                        </div>
                    </a>
                    {{-- Botón 4: Biblioteca --}}
                    <a href="{{ route('docente.biblioteca.index') }}"
                        class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-purple-700 to-indigo-800
          p-6 shadow-lg hover:shadow-xl hover:shadow-purple-500/30
          transform hover:-translate-y-1 transition-all duration-300">
                        <div <!-- Imagen tipo Icono/Ilustración -->
                            <img src="{{ asset('images/bibliotecaIco.ico') }}" alt="Icono Biblioteca"
                                class="w-12 h-12 object-contain rounded-lg bg-white/10 p-1 group-hover:rotate-6 transition-transform duration-300">
                            <div>
                                <h3 class="text-xl font-bold text-white">Biblioteca</h3>
                                <p class="text-sm text-gray-300">Compartí videos, podcasts, infografías y más</p>
                            </div>
                        </div>
                    </a>

                    {{-- Botón 5: Talleres --}}
                    <a href="{{ route('docente.taller.index') }}"
                        class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-emerald-700 to-teal-800
          p-6 shadow-lg hover:shadow-xl hover:shadow-emerald-500/30
          transform hover:-translate-y-1 transition-all duration-300">
                        <div <!-- Imagen tipo Icono/Ilustración -->
                            <img src="{{ asset('images/talleresIco.ico') }}" alt="Icono Mis Talleres"
                                class="w-12 h-12 object-contain rounded-lg bg-white/10 p-1 group-hover:rotate-6 transition-transform duration-300 ">
                            <div>
                                <h3 class="text-xl font-bold text-white">Mis Talleres</h3>
                                <p class="text-sm text-gray-300">Crea y gestiona ejercicios para tus alumnos</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endrole
        </div>
        <div class="max-w-7xl mx-auto px-6 py-10 space-y-6">
            {{-- ADMIN --}}
            @role('admin')
                {{-- Tu Grid de 3 columnas ahora sí tendrá el 100% del ancho disponible --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 items-stretch">
                    <a href="{{ route('admin.usuarios') }}"
                        class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-purple-700 to-indigo-800
          p-6 shadow-lg hover:shadow-xl hover:shadow-purple-500/30
          transform hover:-translate-y-1 transition-all duration-300">
                        <div <!-- Imagen tipo Icono/Ilustración -->
                            <img src="{{ asset('images/usersLg.ico') }}" alt="Icono Administrar usuarios"
                                class="w-12 h-12 object-contain rounded-lg bg-white/10 p-1 group-hover:rotate-6 transition-transform duration-300">
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
                        <div <!-- Imagen tipo Icono/Ilustración -->
                            <img src="{{ asset('images/cursosLg.ico') }}" alt="Icono Administrar cursos"
                                class="w-12 h-12 object-contain rounded-lg bg-white/10 p-1 group-hover:rotate-6 transition-transform duration-300">
                            <div>
                                <h3 class="text-lg font-bold text-white">Administrar cursos</h3>
                                <p class="text-sm text-cyan-100 mt-1">Unidades, temarios y profesores</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endrole
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
