@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-12">
        <div class="max-w-2xl mx-auto px-4">
            <div class="container">
                {{-- Header con búsqueda y botón --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="d-flex align-items-center">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                            <i class="bi bi-folder-fill me-2"></i>Mis materiales
                            <span class="badge bg-secondary ms-2">{{ $materiales->count() }}</span>
                        </h2>
                    </div>
                    <a href="{{ route('materiales.create') }}" class="btn btn-primary dark:text-gray-100">
                        <i class="bi bi-cloud-arrow-up me-1 "></i>Subir material
                    </a>
                </div>
                {{-- Card --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 sm:p-8">
                    @csrf

                    {{-- Barra de filtros --}}
                    <form method="GET" action="{{ route('materiales.index') }}"
                        class="row g-4 justify-content-center mb-4" id="filters">
                        <div class="col-xl-10 col-lg-11"> {{-- ancho máximo sin mx-auto doble --}}

                            <div class="col-md-5">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                                    <input type="text" name="q" value="{{ request('q') }}"
                                        placeholder="Buscar por título o curso…" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <select name="curso" class="form-select">
                                    <option value="">Todos los cursos</option>
                                    @foreach ($cursos as $c)
                                        <option value="{{ $c->id }}" @selected(request('curso') == $c->id)>
                                            {{ $c->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2">
                                <select name="sort" class="form-select">
                                    <option value="desc" @selected(request('sort') !== 'asc')>Más reciente</option>
                                    <option value="asc" @selected(request('sort') === 'asc')>Más antiguo</option>
                                </select>
                            </div>

                            <div class="col-md-2 d-grid">
                                <button class="btn btn-outline-secondary dark:text-gray-100" type="submit">Filtrar</button>
                            </div>

                        </div>
                    </form>

                    {{-- Listado --}}
                    @forelse ($materiales as $mat)
                        <div class="card material-card mb-3 shadow-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    {{-- Info --}}
                                    <div class="col-md-7">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h6 class="mb-0 fw-bold dark:text-gray-100" data-bs-toggle="tooltip"
                                                    title="{{ $mat->titulo }}">
                                                    {{ Str::limit($mat->titulo, 50) }}
                                                </h6>
                                                <p class="mb-0 small text-muted dark:text-gray-100">
                                                    Curso:
                                                    <strong>{{ optional($mat->curso)->nombre ?? 'Sin curso' }}</strong>
                                                    · {{ $mat->created_at->diffForHumans() }}
                                                </p>
                                            </div>
                                            <div class="text-end dark:text-gray-100">
                                                @php
                                                    $ext = pathinfo($mat->file_path, PATHINFO_EXTENSION);
                                                    $size = Storage::exists($mat->file_path)
                                                        ? number_format(Storage::size($mat->file_path) / 1048576, 2) .
                                                            ' MB'
                                                        : '? MB';
                                                @endphp
                                                <span class="badge bg-light text-dark">{{ strtoupper($ext) }}</span>
                                                <span class="badge bg-light text-dark">{{ $size }} MB</span>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Botones --}}
                                    <div class="col-md-5 text-end">
                                        <a href="{{ Storage::url($mat->file_path) }}" target="_blank"
                                            class="btn btn-sm btn-outline-primary dark:text-gray-100">
                                            <i class="bi bi-download"></i> Descargar
                                        </a>
                                        <a href="{{ route('materiales.edit', $mat) }}"
                                            class="btn btn-sm btn-outline-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('materiales.destroy', $mat) }}" method="POST"
                                            class="d-inline delete-form">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger" type="submit">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5">
                            <i class="bi bi-inbox display-4 text-muted"></i>
                            <p class="text-muted mt-2">No se encontraron materiales.</p>
                            <a href="{{ route('materiales.create') }}" class="btn btn-primary mt-3">
                                Subir el primero
                            </a>
                        </div>
                    @endforelse

                    {{-- Paginación --}}
                    <div class="d-flex justify-content-center mt-4">
                        {{ $materiales->appends(request()->query())->links() }}
                    </div>
                </div>

                @push('styles')
                    <style>
                        .material-card {
                            transition: transform .15s ease-in-out;
                        }

                        .material-card:hover {
                            transform: translateY(-2px);
                        }

                        .delete-form button {
                            border: none;
                            background: transparent;
                        }
                    </style>
                @endpush

                @push('scripts')
                    <script>
                        // Tooltips
                        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                        tooltipTriggerList.map(function(el) {
                            return new bootstrap.Tooltip(el);
                        });

                        // Confirmar borrado con SweetAlert2 (opcional)
                        document.querySelectorAll('.delete-form').forEach(form => {
                            form.addEventListener('submit', e => {
                                e.preventDefault();
                                Swal.fire({
                                    title: '¿Borrar material?',
                                    text: "No podrás deshacer esta acción.",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#d33',
                                    cancelButtonColor: '#6c757d',
                                    confirmButtonText: 'Sí, borrar'
                                }).then(result => {
                                    if (result.isConfirmed) form.submit();
                                });
                            });
                        });
                    </script>
                @endpush
            @endsection
