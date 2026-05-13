@extends('layouts.app')

@section('content')
<style>
    /* 1. Definición de Variables Dinámicas */
    :root {
        --card-bg: rgba(255, 255, 255, 0.95);
        --input-bg: #ffffff;
        --text-main: #2d3436;
        --border-color: #eef2f7;
        --shadow-color: rgba(0,0,0,0.08);
        --breadcrumb-link: #6c757d;
    }

    /* 2. Variables para Modo Oscuro (se activa con la clase 'dark' o el atributo 'data-bs-theme') */
    [data-bs-theme='dark'] {
        --card-bg: #1e1e26;
        --input-bg: #2a2a35;
        --text-main: #f8f9fa;
        --border-color: #3f3f4d;
        --shadow-color: rgba(0,0,0,0.4);
        --breadcrumb-link: #adb5bd;
    }

    body {
        background: var(--bs-body-bg); /* Usa el fondo nativo de Bootstrap 5.3 */
        transition: background-color 0.3s ease;
    }

    .card-modern {
        background-color: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 24px;
        box-shadow: 0 20px 40px var(--shadow-color);
        transition: all 0.3s ease;
    }

    /* Encabezado: mantenemos el gradiente porque luce bien en ambos */
    .card-header-premium {
        background: linear-gradient(45deg, #4facfe 0%, #00f2fe 100%);
        border: none;
        padding: 1.5rem;
    }

    .form-label { color: var(--text-main); }

    .form-control {
        background-color: var(--input-bg);
        border: 2px solid var(--border-color);
        color: var(--text-main);
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        background-color: var(--input-bg);
        color: var(--text-main);
        border-color: #4facfe;
        box-shadow: 0 0 0 4px rgba(79, 172, 254, 0.2);
    }

    .input-group-text {
        background-color: var(--border-color);
        border: 2px solid var(--border-color);
        color: var(--text-main);
    }

    .badge-format {
        background: rgba(79, 172, 254, 0.15);
        color: #4facfe;
        font-weight: 600;
    }

    .btn-save {
        background: linear-gradient(45deg, #4facfe 0%, #00f2fe 100%);
        border: none;
        border-radius: 12px;
        font-weight: 700;
        transition: all 0.3s ease;
    }

    .btn-save:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(79, 172, 254, 0.4);
    }

    .breadcrumb-item a { color: var(--breadcrumb-link); text-decoration: none; }
    .breadcrumb-item.active { color: #4facfe; }

    .animate-up {
        animation: fadeInUp 0.6s ease-out;
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="container mx-auto px-4 py-8 max-w-5xl">
    <div class="row justify-content-center">
        <div class="col-md-8 animate-up">

            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('portfolios.index') }}">📂 Portafolios</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nuevo Proyecto</li>
                </ol>
            </nav>

            <div class="card card-modern">
                <div class="card-header card-header-premium text-white">
                    <div class="d-flex align-items-center">
                        <div class="bg-white text-primary rounded-circle p-2 me-3 shadow" style="width: 40px; height: 40px; display: grid; place-items: center;">
                            <i class="fas fa-magic"></i>
                        </div>
                        <h4 class="mb-0 fw-bold">Crear Nuevo Portafolio</h4>
                    </div>
                </div>

                <div class="card-body p-4 p-lg-5">
                    <form action="{{ route('portfolios.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label fw-bold">Título del Proyecto</label>
                            <input type="text" name="title" class="form-control form-control-lg @error('title') is-invalid @enderror"
                                   value="{{ old('title') }}" placeholder="Ej: Mi Obra Maestra" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Descripción</label>
                            <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror"
                                      placeholder="Describe tu trabajo..." required>{{ old('description') }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Archivo o Imagen</label>
                            <div class="input-group">
                                <input type="file" name="file" class="form-control @error('file') is-invalid @enderror">
                                <span class="input-group-text"><i class="fas fa-upload"></i></span>
                            </div>
                            <div class="mt-3">
                                <span class="badge badge-format rounded-pill px-3">PDF</span>
                                <span class="badge badge-format rounded-pill px-3">JPG</span>
                                <span class="badge badge-format rounded-pill px-3">PNG</span>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-5">
                            <a href="{{ route('portfolios.index') }}" class="btn btn-link text-decoration-none text-muted fw-bold">
                                <i class="fas fa-times me-1"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-save text-white px-5 py-2 shadow">
                                Guardar Proyecto <i class="fas fa-check-circle ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
