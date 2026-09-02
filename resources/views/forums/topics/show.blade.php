@extends('layouts.app')

@section('content')
    <style>
        /* --- Variables dinámicas --- */
        :root {
            --forum-card-bg: #ffffff;
            --forum-sidebar-bg: #f8f9fa;
            --forum-text-main: #2d3436;
            --forum-text-muted: #636e72;
            --forum-border: #edf2f7;
            --forum-shadow: rgba(0, 0, 0, 0.05);
        }

        [data-bs-theme="dark"] {
            --forum-card-bg: #1e1e1e;
            --forum-sidebar-bg: #252525;
            --forum-text-main: #e1e1e1;
            --forum-text-muted: #a0a0a0;
            --forum-border: #333333;
            --forum-shadow: rgba(0, 0, 0, 0.3);
        }

        /* --- Aplicación de estilos --- */
        body {
            background-color: var(--bs-body-bg);
            color: var(--forum-text-main);
            transition: background-color 0.3s ease;
        }

        .forum-post {
            background-color: var(--forum-card-bg) !important;
            border: 1px solid var(--forum-border) !important;
            border-radius: 12px !important;
            box-shadow: 0 4px 6px var(--forum-shadow) !important;
            overflow: hidden;
        }

        .author-sidebar {
            background-color: var(--forum-sidebar-bg) !important;
            border-color: var(--forum-border) !important;
        }

        .post-content {
            color: var(--forum-text-main);
            line-height: 1.7;
        }

        .post-date {
            color: var(--forum-text-muted);
        }

        /* Badge de rol con estilo sutil */
        .role-badge {
            background-color: rgba(13, 110, 253, 0.1);
            color: #0d6efd;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Área de respuesta */
        .reply-card {
            background-color: var(--forum-card-bg) !important;
            border-radius: 16px !important;
        }

        .custom-textarea {
            background-color: var(--forum-sidebar-bg) !important;
            border: 2px solid var(--forum-border) !important;
            color: var(--forum-text-main) !important;
            border-radius: 10px;
        }

        .custom-textarea:focus {
            background-color: var(--forum-card-bg) !important;
            border-color: #0d6efd !important;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
        }

        /* Estilo para los textos del encabezado */
        [data-bs-theme="dark"] .display-6 {
            color: #ffffff !important;
        }

        .custom-breadcrumb .breadcrumb-item+.breadcrumb-item::before {
            content: "›";
            /* Un separador más elegante */
            font-size: 1.2rem;
            vertical-align: middle;
            color: #6c757d;
        }

        .breadcrumb-pill {
            padding: 0.4rem 0.8rem;
            border-radius: 50px;
            background-color: #f8f9fa;
            color: #495057;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
        }

        .breadcrumb-pill:hover {
            background-color: #e9ecef;
            color: #0d6efd;
            transform: translateY(-1px);
        }

        .breadcrumb-pill.active {
            background-color: #e7f1ff;
            color: #0d6efd;
            font-weight: 600;
        }
    </style>
    <div class="container py-5 max-w-5xl mx-auto">
        <!-- Navegación jerárquica dentro de una Card -->
        <div
            class="px-6 py-2 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-purple-500/50">
            <div class="card-body py-2 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 align-items-center custom-breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('forums.index') }}" class="breadcrumb-pill">
                                <i class="bi bi-house-door-fill me-1"></i> Foros
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('forums.show', $forum) }}" class="breadcrumb-pill">
                                {{ $forum->title }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <span class="breadcrumb-pill active">{{ $topic->title }}</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-10 mx-auto">
                <!-- Encabezado del Tema -->
                <div
                    class="px-6 py-2 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-purple-500/50">
                    <div>
                        <h1 class="display-6 fw-bold text-dark mb-1">{{ $topic->title }}</h1>
                        <p class="text-muted mb-0">Discusión iniciada en <span
                                class="text-primary fw-medium">{{ $forum->title }}</span></p>
                    </div>
                    <span class="badge rounded-pill bg-soft-primary text-primary px-3 py-2">
                        <i class="bi bi-chat-left-text me-1"></i> {{ $topic->posts->count() }} respuestas
                    </span>
                </div>

                <!-- Listado de Posts -->
                @foreach ($topic->posts as $post)
                    <div class="card forum-post mb-4 border-0 shadow-sm">
                        <div class="card-body p-0">
                            <div class="row g-0">
                                <!-- Sidebar del Autor -->
                                <div class="col-md-2 author-sidebar p-4 border-end bg-light-subtle text-center">
                                    <div class="avatar-wrapper mb-3">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($post->user->name) }}&background=0d6efd&color=fff&size=128"
                                            alt="{{ $post->user->name }}"
                                            class="rounded-circle shadow-sm border border-3 border-white">
                                    </div>
                                    <h6 class="mb-1 fw-bold text-truncate">{{ $post->user->name }}</h6>
                                    <span class="badge role-badge">{{ $post->user->role ?? 'Miembro' }}</span>
                                </div>

                                <!-- Contenido del Post -->
                                <div class="col-md-10 p-4 d-flex flex-column">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <small class="post-date">
                                            <i class="bi bi-clock me-1"></i> {{ $post->created_at->diffForHumans() }}
                                        </small>
                                        @can('update', $post)
                                            <div class="dropdown">
                                                <button class="btn btn-options" data-bs-toggle="dropdown">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                                    <li><a class="dropdown-item" href="#"><i
                                                                class="bi bi-pencil me-2"></i> Editar</a></li>
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                    <li><a class="dropdown-item text-danger" href="#"><i
                                                                class="bi bi-trash me-2"></i> Eliminar</a></li>
                                                </ul>
                                            </div>
                                        @endcan
                                    </div>
                                    <div class="post-content flex-grow-1 text-secondary">
                                        {!! nl2br(e($post->content)) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Formulario de respuesta rápida -->
                <div class="card mt-5 border-0 shadow-lg reply-card">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">Añadir una respuesta</h5>
                        <form action="{{ route('topics.posts.store', $topic) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <textarea name="content" class="form-control custom-textarea" rows="5"
                                    placeholder="Comparte tus ideas con la comunidad..."></textarea>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary px-4 py-2 fw-bold shadow-sm">
                                    <i class="bi bi-send me-2"></i> Publicar respuesta
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
