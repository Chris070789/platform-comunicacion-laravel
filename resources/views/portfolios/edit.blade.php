@extends('layouts.app')

@section('content')
    <style>
        /* 1. Definición de Variables Dinámicas */
        :root {
            --edit-card-bg: #ffffff;
            --edit-input-bg: #ffffff;
            --edit-text-title: #2d3436;
            --edit-text-muted: #636e72;
            --edit-border: #eef2f7;
            --edit-shadow: rgba(0, 0, 0, 0.08);
        }

        [data-bs-theme='dark'] {
            --edit-card-bg: #1e1e26;
            --edit-input-bg: #2a2a35;
            --edit-text-title: #f8f9fa;
            --edit-text-muted: #adb5bd;
            --edit-border: #3f3f4d;
            --edit-shadow: rgba(0, 0, 0, 0.4);
        }

        /* 2. Estilos de la Tarjeta */
        .card-edit {
            background-color: var(--edit-card-bg);
            border: 1px solid var(--edit-border);
            border-radius: 24px;
            box-shadow: 0 20px 40px var(--edit-shadow);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        /* Encabezado: Gradiente Cálido para Edición */
        .header-edit {
            background: linear-gradient(45deg, #ff9a9e 0%, #fecfef 99%, #fecfef 100%);
            /* Opcional: un degradado más fuerte para modo oscuro */
            padding: 1.5rem;
            border: none;
        }

        [data-bs-theme='dark'] .header-edit {
            background: linear-gradient(45deg, #d4418e 0%, #0652c5 74%);
        }

        .form-label {
            color: var(--edit-text-title);
            font-weight: 700;
            font-size: 0.95rem;
        }

        .form-control {
            background-color: var(--edit-input-bg);
            border: 2px solid var(--edit-border);
            color: var(--edit-text-title);
            border-radius: 12px;
            padding: 0.8rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background-color: var(--edit-input-bg);
            color: var(--edit-text-title);
            border-color: #4facfe;
            box-shadow: 0 0 0 4px rgba(79, 172, 254, 0.2);
        }

        /* Caja de archivo actual */
        .current-file-box {
            background-color: var(--edit-input-bg);
            border: 1px dashed var(--edit-border);
            border-radius: 15px;
            padding: 1rem;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .btn-update {
            background: linear-gradient(45deg, # 0%, #fecfef 100%);
            border: none;
            border-radius: 12px;
            font-weight: 700;
            color: #333;
            transition: all 0.3s ease;
        }

        [data-bs-theme='dark'] .btn-update {
            background: linear-gradient(45deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }

        .btn-update:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(79, 172, 254, 0.4);
        }

        .animate-in {
            animation: fadeInUp 0.5s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <div class="container py-5 mx-auto px-4 py-8 max-w-5xl">
        <div class="row justify-content-center">
            <div class="col-lg-8 animate-in">



                <div class="card card-edit">
                    <div class="header-edit text-white">
                        <div class="d-flex align-items-center">
                            <div class="bg-white text-danger rounded-circle p-2 me-3 shadow"
                                style="width: 40px; height: 40px; display: grid; place-items: center;">
                                <i class="fas fa-edit"></i>
                            </div>
                            <div>
                                <h4 class="mb-0 fw-bold text-dark">Panel de Edición</h4>
                                <small class="text-dark opacity-75">Modificando: {{ $portfolio->title }}</small>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4 p-lg-5">
                        <form action="{{ route('portfolios.update', $portfolio->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- Título --}}
                            <div class="mb-4">
                                <label class="form-label">Título del Proyecto</label>
                                <input type="text" name="title"
                                    class="form-control form-control-lg @error('title') is-invalid @enderror"
                                    value="{{ old('title', $portfolio->title) }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Descripción --}}
                            <div class="mb-4">
                                <label class="form-label">Descripción Detallada</label>
                                <textarea name="description" rows="5" class="form-control @error('description') is-invalid @enderror"
                                    placeholder="¿Qué ha cambiado en este proyecto?" required>{{ old('description', $portfolio->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Gestión de Archivos --}}
                            <div class="mb-4">
                                <label class="form-label">Archivo Adjunto</label>

                                @if ($portfolio->file_path)
                                    <div class="current-file-box mb-3">
                                        <div class="icon-box p-2 bg-light rounded text-primary">
                                            <i class="fas fa-file-alt fa-2x"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <p class="mb-0 text-muted small fw-bold">Archivo actual registrado:</p>
                                            <a href="{{ asset('storage/' . $portfolio->file_path) }}" target="_blank"
                                                class="text-decoration-none small">
                                                {{ basename($portfolio->file_path) }} <i
                                                    class="fas fa-external-link-alt ms-1"></i>
                                            </a>
                                        </div>
                                        <span
                                            class="badge rounded-pill bg-success-subtle text-success border border-success">Activo</span>
                                    </div>
                                @endif

                                <div class="input-group">
                                    <input type="file" name="file"
                                        class="form-control @error('file') is-invalid @enderror">
                                    <span class="input-group-text"><i class="fas fa-cloud-upload-alt"></i></span>
                                </div>
                                <div class="form-text mt-2 text-muted italic">
                                    <i class="fas fa-info-circle me-1"></i> Sube un nuevo archivo solo si deseas reemplazar
                                    el actual.
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-5">
                                <a href="{{ route('portfolios.index') }}"
                                    class="btn btn-link text-decoration-none text-muted fw-bold">
                                    <i class="fas fa-arrow-left me-1"></i> Cancelar
                                </a>
                                <button type="submit" class="btn btn-update px-5 py-2 shadow-sm">
                                    Guardar Cambios <i class="fas fa-check-circle ms-2"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
