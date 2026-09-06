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
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 mx-auto">

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
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">

        {{-- SECCIÓN SUPERIOR: BIENVENIDA / MASCOTA (Ocupa todo el ancho superior) --}}
        @role('alumno')
        <div class="bg-gradient-to-r from-indigo-900 via-purple-900 to-slate-900 rounded-3xl p-6 md:p-8 text-white shadow-xl relative overflow-hidden border border-white/10 flex flex-col md:flex-row items-center justify-between gap-6">

            {{-- Texto de Bienvenida --}}
            <div class="space-y-2 text-center md:text-left z-10">
                <span class="bg-yellow-400 text-yellow-950 font-black px-3 py-1 rounded-full text-xs uppercase tracking-wider">
                    👋 ¡Hola de nuevo!
                </span>
                <h2 class="text-2xl md:text-3xl font-black tracking-tight">
                    ¿Listo para continuar tu aprendizaje?
                </h2>
                <p class="text-purple-200/80 text-sm max-w-xl">
                    Sigue completando tus etapas, gana medallas y descubre nuevo contenido en la biblioteca.
                </p>
            </div>

            {{-- Imagen Mascota Ordenada --}}
            <div class="relative z-10 shrink-0">
                <img src="{{ asset('images/chacharaMensaje.png') }}"
                    alt="Mascota Mensaje"
                    class="w-48 h-48 md:w-56 md:h-56 object-contain drop-shadow-2xl animate-pulse">
            </div>

            {{-- Elemento decorativo de fondo --}}
            <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-purple-500/10 rounded-full blur-3xl pointer-events-none"></div>
        </div>

        {{-- CONTENEDOR PRINCIPAL EN GRID (2 Columnas en pantallas medianas/grandes) --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">

            {{-- COLUMNA IZQUIERDA: ACCIONES Y CAMINO (2/3 del ancho en pantallas grandes) --}}
            <div class="md:col-span-2 space-y-8">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                    {{-- BOTÓN 1: MIS CURSOS (Estilo Misión Azul Gamer) --}}
                    <a href="{{ route('alumno.cursos.index') }}"
                        class="group relative block rounded-3xl bg-gradient-to-br from-blue-500 via-indigo-600 to-indigo-800 p-1.5 shadow-xl shadow-indigo-500/20 hover:shadow-indigo-500/40 border-b-8 border-indigo-950 active:border-b-2 active:translate-y-1.5 transition-all duration-200 overflow-hidden">

                        {{-- Destello de brillo de fondo al pasar el cursor --}}
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000 ease-out pointer-events-none"></div>

                        {{-- Contenido Interno --}}
                        <div class="relative z-10 flex items-center space-x-4 bg-slate-900/40 backdrop-blur-sm rounded-[calc(1.5rem-6px)] p-5">

                            {{-- Icono flotante con fondo resplandeciente --}}
                            <div class="shrink-0 relative">
                                <div class="absolute inset-0 bg-cyan-400/30 rounded-2xl blur-md group-hover:blur-lg transition-all"></div>
                                <div class="relative w-16 h-16 rounded-2xl bg-gradient-to-tr from-cyan-400 to-blue-500 p-2.5 shadow-inner border border-white/40 flex items-center justify-center transform group-hover:scale-110 group-hover:-rotate-6 transition-transform duration-300">
                                    <img src="{{ asset('images/cursoLg.png') }}" alt="Mis Cursos" class="w-full h-full object-contain drop-shadow">
                                </div>
                            </div>

                            {{-- Texto e Indicador --}}
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-0.5">
                                    <span class="bg-cyan-400 text-cyan-950 font-black text-[10px] uppercase px-2 py-0.5 rounded-full shadow-sm">
                                        🎓 Mis Clases
                                    </span>
                                </div>
                                <h3 class="text-xl font-black text-white tracking-wide group-hover:text-yellow-300 transition-colors">
                                    Mis Cursos
                                </h3>
                                <p class="text-xs font-semibold text-blue-100/90 leading-tight mt-1">
                                    ¡Entra a estudiar y completa tus lecciones!
                                </p>
                            </div>

                            {{-- Flecha tipo juego --}}
                            <div class="text-white/60 group-hover:text-yellow-300 group-hover:translate-x-1 transition-all text-xl pr-1">
                                <i class="bi bi-chevron-right font-black"></i>
                            </div>
                        </div>

                        {{-- Elemento gigante decorativo al fondo --}}
                        <i class="bi bi-controller absolute -right-2 -bottom-4 text-7xl text-white/10 group-hover:scale-125 group-hover:rotate-12 transition-transform duration-500 pointer-events-none"></i>
                    </a>

                    {{-- BOTÓN 2: BIBLIOTECA (Estilo Cofre de Magia Naranja/Púrpura) --}}
                    <a href="{{ route('alumno.biblioteca.index') }}"
                        class="group relative block rounded-3xl bg-gradient-to-br from-amber-400 via-orange-500 to-purple-700 p-1.5 shadow-xl shadow-orange-500/20 hover:shadow-orange-500/40 border-b-8 border-purple-950 active:border-b-2 active:translate-y-1.5 transition-all duration-200 overflow-hidden">

                        {{-- Destello de brillo de fondo al pasar el cursor --}}
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000 ease-out pointer-events-none"></div>

                        {{-- Contenido Interno --}}
                        <div class="relative z-10 flex items-center space-x-4 bg-slate-900/40 backdrop-blur-sm rounded-[calc(1.5rem-6px)] p-5">

                            {{-- Icono flotante con fondo resplandeciente --}}
                            <div class="shrink-0 relative">
                                <div class="absolute inset-0 bg-yellow-400/30 rounded-2xl blur-md group-hover:blur-lg transition-all"></div>
                                <div class="relative w-16 h-16 rounded-2xl bg-gradient-to-tr from-yellow-300 to-amber-500 p-2.5 shadow-inner border border-white/40 flex items-center justify-center transform group-hover:scale-110 group-hover:rotate-6 transition-transform duration-300">
                                    <img src="{{ asset('images/bibliotecaLg.png') }}" alt="Biblioteca" class="w-full h-full object-contain drop-shadow">
                                </div>
                            </div>

                            {{-- Texto e Indicador --}}
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-0.5">
                                    <span class="bg-yellow-300 text-amber-950 font-black text-[10px] uppercase px-2 py-0.5 rounded-full shadow-sm">
                                        ⭐ Descubrir
                                    </span>
                                </div>
                                <h3 class="text-xl font-black text-white tracking-wide group-hover:text-yellow-300 transition-colors">
                                    Biblioteca
                                </h3>
                                <p class="text-xs font-semibold text-orange-100/90 leading-tight mt-1">
                                    ¡Explora vídeos divertidos y guías mágicas!
                                </p>
                            </div>

                            {{-- Flecha tipo juego --}}
                            <div class="text-white/60 group-hover:text-yellow-300 group-hover:translate-x-1 transition-all text-xl pr-1">
                                <i class="bi bi-chevron-right font-black"></i>
                            </div>
                        </div>

                        {{-- Elemento gigante decorativo al fondo --}}
                        <i class="bi bi-stars absolute -right-2 -bottom-4 text-7xl text-white/10 group-hover:scale-125 group-hover:-rotate-12 transition-transform duration-500 pointer-events-none"></i>
                    </a>

                </div>

                {{-- Listado de Etapas --}}
                <div class="space-y-4">
                    <div class="relative pb-2 mb-6 border-b border-gray-100 dark:border-gray-800/60">
                        <h3 class="text-lg font-extrabold flex items-center gap-3 text-gray-900 dark:text-white tracking-tight">
                            <div class="p-2 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 text-white shadow-md shadow-indigo-500/20 shrink-0">
                                <i class="bi bi-signpost-split flex text-base"></i>
                            </div>
                            <div>
                                <span class="block">Mi Camino de Aprendizaje</span>
                                <span class="block text-xs font-normal text-gray-400 dark:text-gray-500 mt-0.5">Sigue tu progreso etapa por etapa</span>
                            </div>
                        </h3>
                    </div>

                    <div class="grid gap-4">
                        @foreach ($stages as $stage)
                        <div class="bg-white dark:bg-gray-800 p-5 rounded-2xl border border-gray-100 dark:border-gray-700/70 shadow-sm flex items-center justify-between group hover:border-indigo-400 dark:hover:border-indigo-500 hover:shadow-md transition-all duration-300">
                            <div class="pr-4">
                                <h4 class="font-bold text-gray-800 dark:text-gray-100 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                    {{ $stage->name }}
                                </h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 line-clamp-1 leading-relaxed">
                                    {{ $stage->description }}
                                </p>
                            </div>
                            <a href="{{ route('dashboard.stage', $stage->id) }}"
                                class="p-2 bg-indigo-50 text-indigo-600 rounded-lg group-hover:bg-indigo-600 group-hover:text-white transition-colors shrink-0">
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>

            {{-- COLUMNA DERECHA: PROGRESO Y LOGROS (1/3 del ancho en pantallas grandes) --}}
            <div class="md:col-span-1 space-y-8">

                {{-- Card de Progreso Espectacular Gamer --}}
                <div class="relative bg-white dark:bg-gray-800 p-6 rounded-3xl shadow-xl border-2 border-indigo-100 dark:border-indigo-900/50 text-center overflow-hidden">

                    {{-- Efecto de luz neón de fondo --}}
                    <div class="absolute -top-12 -left-12 w-32 h-32 bg-indigo-500/20 rounded-full blur-2xl pointer-events-none"></div>
                    <div class="absolute -bottom-12 -right-12 w-32 h-32 bg-purple-500/20 rounded-full blur-2xl pointer-events-none"></div>

                    {{-- Encabezado --}}
                    <div class="relative z-10 mb-4 flex items-center justify-center gap-2">
                        <span class="text-xl">⚡</span>
                        <h3 class="text-lg font-black bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 bg-clip-text text-transparent tracking-tight uppercase">
                            Nivel de Energía
                        </h3>
                    </div>

                    {{-- Medidor Circular SVG Interactivo --}}
                    <div class="relative z-10 inline-flex items-center justify-center w-48 h-48 my-2">

                        {{-- Gráfico SVG de Progreso Circular --}}
                        <svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100">
                            {{-- Definición de Degradados Neón --}}
                            <defs>
                                <linearGradient id="gradientProgress" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" stop-color="#38bdf8" /> {{-- Cyan --}}
                                    <stop offset="50%" stop-color="#818cf8" /> {{-- Indigo --}}
                                    <stop offset="100%" stop-color="#c084fc" /> {{-- Purple --}}
                                </linearGradient>
                            </defs>

                            {{-- Círculo base de fondo (Gris/Oscuro) --}}
                            <circle cx="50" cy="50" r="40"
                                class="text-gray-100 dark:text-gray-700/60 stroke-current"
                                stroke-width="10"
                                fill="transparent" />

                            {{-- Círculo de Progreso Animado --}}
                            <circle cx="50" cy="50" r="40"
                                stroke="url(#gradientProgress)"
                                stroke-width="10"
                                stroke-dasharray="251.2"
                                stroke-dashoffset="{{ 251.2 - (251.2 * round($progress)) / 100 }}"
                                stroke-linecap="round"
                                fill="transparent"
                                class="transition-all duration-1000 ease-out drop-shadow-[0_0_8px_rgba(129,140,248,0.5)]" />
                        </svg>

                        {{-- Contenido del Centro --}}
                        <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                            {{-- Icono según progreso --}}
                            <span class="text-2xl animate-bounce mb-1">
                                @if($progress == 100)
                                🏆
                                @elseif($progress >= 50)
                                🔥
                                @else
                                🚀
                                @endif
                            </span>

                            {{-- Porcentaje Grande --}}
                            <span class="text-4xl font-black bg-gradient-to-b from-indigo-600 to-purple-800 dark:from-indigo-400 dark:to-purple-300 bg-clip-text text-transparent tracking-tighter">
                                {{ round($progress) }}<span class="text-2xl font-extrabold">%</span>
                            </span>

                            {{-- Badge del estado --}}
                            <span class="text-[10px] font-black uppercase tracking-widest px-2 py-0.5 rounded-full bg-indigo-100 dark:bg-indigo-950 text-indigo-700 dark:text-indigo-300 mt-0.5 border border-indigo-300/30">
                                @if($progress == 100)
                                ¡Leyenda!
                                @elseif($progress >= 50)
                                ¡Avanzando!
                                @else
                                ¡En Marcha!
                                @endif
                            </span>
                        </div>
                    </div>

                    {{-- Mini Barra de Experiencia estilo RPG --}}
                    <div class="relative z-10 mt-4 bg-gray-50 dark:bg-gray-700/40 p-3 rounded-2xl border border-gray-100 dark:border-gray-700/60">
                        <div class="flex justify-between items-center text-xs font-bold text-gray-600 dark:text-gray-300 mb-1.5">
                            <span class="flex items-center gap-1">🚩 Etapas Superadas</span>
                            <span class="text-indigo-600 dark:text-indigo-400 font-black">{{ $completedStages }} / {{ $totalStages }}</span>
                        </div>

                        {{-- Barra horizontal de progreso --}}
                        <div class="w-full bg-gray-200 dark:bg-gray-600 h-3 rounded-full overflow-hidden p-0.5">
                            <div class="bg-gradient-to-r from-cyan-400 via-indigo-500 to-purple-500 h-full rounded-full transition-all duration-1000 shadow-sm"
                                style="width: {{ $totalStages > 0 ? ($completedStages / $totalStages) * 100 : 0 }}%;">
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Card de Logros Mejorada --}}
                <div class="bg-white dark:bg-gray-800 p-6 rounded-3xl shadow-lg border border-gray-100 dark:border-gray-700">
                    <h5 class="font-extrabold mb-6 flex items-center justify-center text-gray-800 dark:text-white tracking-tight text-lg">
                        <i class="bi bi-star-fill text-yellow-400 mr-2 text-xl animate-spin" style="animation-duration: 8s;"></i>
                        Mis Logros
                    </h5>

                    <div class="flex flex-wrap justify-center gap-6">

                        {{-- Insignia 1: Tarea Completada --}}
                        <div class="flex flex-col items-center group cursor-pointer transition-transform duration-300 hover:scale-105 {{ $completedStages == $totalStages && $totalStages > 0 ? '' : 'opacity-40 grayscale' }}">
                            <div class="relative flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-tr from-amber-500 via-yellow-400 to-amber-300 text-yellow-950 text-3xl font-black shadow-lg shadow-yellow-500/30 border-2 border-yellow-200 group-hover:rotate-6 transition-all duration-300">

                                {{-- Brillo superior en la medalla --}}
                                <div class="absolute inset-0 rounded-2xl bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity"></div>

                                @if ($completedStages == $totalStages && $totalStages > 0)
                                <i class="bi bi-trophy-fill drop-shadow-md"></i>
                                @else
                                <i class="bi bi-lock-fill text-gray-700 opacity-70"></i>
                                @endif
                            </div>

                            <span class="mt-2.5 text-xs font-black text-gray-700 dark:text-gray-200 text-center tracking-tight">
                                {{ $completedStages == $totalStages && $totalStages > 0 ? '¡Tarea Completada!' : 'Bloqueado' }}
                            </span>
                            <span class="text-[10px] text-gray-400 font-medium">100% Finalizado</span>
                        </div>

                        {{-- Insignia 2: Buen Trabajo --}}
                        <div class="flex flex-col items-center group cursor-pointer transition-transform duration-300 hover:scale-105 {{ $completedStages >= $totalStages / 2 && $totalStages > 0 ? '' : 'opacity-40 grayscale' }}">
                            <div class="relative flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-tr from-purple-600 via-indigo-500 to-pink-500 text-white text-3xl font-black shadow-lg shadow-purple-500/30 border-2 border-purple-300 group-hover:-rotate-6 transition-all duration-300">

                                {{-- Brillo superior en la medalla --}}
                                <div class="absolute inset-0 rounded-2xl bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity"></div>

                                @if ($completedStages >= $totalStages / 2 && $totalStages > 0)
                                <i class="bi bi-star-fill drop-shadow-md"></i>
                                @else
                                <i class="bi bi-lock-fill text-purple-200 opacity-70"></i>
                                @endif
                            </div>

                            <span class="mt-2.5 text-xs font-black text-gray-700 dark:text-gray-200 text-center tracking-tight">
                                {{ $completedStages >= $totalStages / 2 && $totalStages > 0 ? '¡Buen Trabajo!' : 'Bloqueado' }}
                            </span>
                            <span class="text-[10px] text-gray-400 font-medium">50% del camino</span>
                        </div>

                    </div>

                    @if ($completedStages == $totalStages && $totalStages > 0)
                    <div class="mt-6 p-3.5 bg-gradient-to-r from-emerald-500/10 via-green-500/10 to-teal-500/10 text-emerald-600 dark:text-emerald-400 rounded-2xl text-xs font-black text-center animate-pulse border border-emerald-500/20 shadow-inner flex items-center justify-center gap-2">
                        <span>🏆</span> ¡Increíble! Has completado todos los ejercicios.
                    </div>
                    @endif
                </div>

            </div>

        </div>
        @endrole

    </div>
    <div class="max-w-7xl mx-auto px-6 py-10 space-y-6">
        {{-- DOCENTE --}}
        @role('docente')
        {{-- Tu Grid de 3 columnas ahora sí tendrá el 100% del ancho disponible --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 items-stretch mx-auto">
            {{-- Botón 1: Cursos --}}
            <a href="{{ route('docente.cursos') }}"
                class="group relative inline-block overflow-hidden rounded-2xl bg-gradient-to-br from-purple-700 to-indigo-800
            p-6 shadow-lg hover:shadow-xl hover:shadow-purple-500/30
            transform hover:-translate-y-1 transition-all duration-300">
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
        const answered = JSON.parse('{{ json_encode($completedStages) }}');
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
</div>
@endsection