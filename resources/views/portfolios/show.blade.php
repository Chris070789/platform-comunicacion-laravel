@extends('layouts.app')

@section('content')
    <style>
        /* 1. Variables de Tema */
        :root {
            --show-card-bg: #ffffff;
            --show-info-bg: #f8f9fa;
            --show-text-title: #2d3436;
            --show-text-body: #636e72;
            --show-border: #eef2f7;
        }

        [data-bs-theme='dark'] {
            --show-card-bg: #1e1e26;
            --show-info-bg: #252530;
            --show-text-title: #ffffff;
            --show-text-body: #b2bec3;
            --show-border: #3f3f4d;
        }

        /* 2. Estilos de la Tarjeta de Exhibición */
        .display-card {
            background-color: var(--show-card-bg);
            border: 1px solid var(--show-border);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        /* Columna de Visualización (Imagen/Icono) */
        .media-viewer {
            background-color: var(--show-info-bg);
            min-height: 400px;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .media-viewer img {
            transition: transform 0.5s ease;
            object-fit: cover;
        }

        .media-viewer:hover img {
            transform: scale(1.05);
        }

        /* Contenido de texto */
        .info-pane {
            padding: 3rem !important;
            color: var(--show-text-body);
        }

        .project-title {
            color: var(--show-text-title);
            font-weight: 850;
            letter-spacing: -1px;
            margin-bottom: 0.5rem;
        }

        .meta-badge {
            background: rgba(79, 172, 254, 0.1);
            color: #4facfe;
            font-size: 0.8rem;
            padding: 0.4rem 1rem;
            border-radius: 50px;
            font-weight: 600;
        }

        /* Botones Premium */
        .btn-action-outline {
            border-radius: 12px;
            font-weight: 600;
            padding: 0.6rem 1.2rem;
            transition: all 0.3s;
        }

        .btn-download-glow {
            background: linear-gradient(45deg, #4facfe 0%, #00f2fe 100%);
            border: none;
            border-radius: 14px;
            font-weight: 700;
            color: white;
            box-shadow: 0 4px 15px rgba(79, 172, 254, 0.3);
        }

        .btn-download-glow:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(79, 172, 254, 0.5);
            color: white;
        }

        /* Animación */
        .reveal {
            animation: slideIn 0.7s cubic-bezier(0.23, 1, 0.32, 1);
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-11 reveal">

                {{-- Cabecera de Navegación --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <a href="{{ route('portfolios.index') }}" class="btn btn-action-outline btn-outline-secondary">
                        <i class="fas fa-chevron-left me-2"></i> Listado
                    </a>

                    @can('update', $portfolio)
                        <a href="{{ route('portfolios.edit', $portfolio->id) }}"
                            class="btn btn-action-outline btn-warning text-dark">
                            <i class="fas fa-edit me-2"></i> Editar Proyecto
                        </a>
                    @endcan
                </div>

                {{-- Tarjeta Principal --}}
                <div class="display-card">
                    <div class="row g-0">

                        {{-- Lado Izquierdo: Visualizador --}}
                        <div class="col-md-6 media-viewer border-end">
                            @if ($portfolio->file_path)
                                @php
                                    $extension = pathinfo($portfolio->file_path, PATHINFO_EXTENSION);
                                    $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                                @endphp

                                @if ($isImage)
                                    <img src="{{ asset('storage/' . $portfolio->file_path) }}" alt="{{ $portfolio->title }}"
                                        class="w-100 h-100">
                                @else
                                    <div class="text-center">
                                        <div class="display-1 mb-2">📂</div>
                                        <span class="badge bg-secondary text-uppercase">{{ $extension }}</span>
                                        <p class="mt-3 text-muted">Documento adjunto</p>
                                    </div>
                                @endif
                            @else
                                <div class="text-center text-muted">
                                    <i class="fas fa-image fa-4x mb-3 opacity-25"></i>
                                    <p>Sin vista previa disponible</p>
                                </div>
                            @endif
                        </div>

                        {{-- Lado Derecho: Información --}}
                        <div class="col-md-6 info-pane d-flex flex-column justify-content-center">
                            <div class="mb-3">
                                <span class="meta-badge">
                                    <i class="far fa-calendar-alt me-1"></i> {{ $portfolio->created_at->format('d M, Y') }}
                                </span>
                            </div>

                            <h1 class="project-title">{{ $portfolio->title }}</h1>

                            <div class="my-4">
                                <h6 class="text-uppercase fw-bold text-primary small letter-spacing-1">Sobre este proyecto
                                </h6>
                                <p class="lead" style="white-space: pre-line; font-size: 1.05rem; line-height: 1.8;">
                                    {{ $portfolio->description }}
                                </p>
                            </div>

                            <div class="mt-auto">
                                @if ($portfolio->file_path)
                                    <hr class="my-4 opacity-50">
                                    <a href="{{ asset('storage/' . $portfolio->file_path) }}" target="_blank"
                                        class="btn btn-download-glow w-100 py-3">
                                        <i class="fas fa-external-link-alt me-2"></i> Abrir Recurso Completo
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div> {{-- Fin Display Card --}}

            </div>
        </div>
    </div>
@endsection
