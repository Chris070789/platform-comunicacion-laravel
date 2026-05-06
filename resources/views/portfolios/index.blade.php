@extends('layouts.app')

@section('content')
<style>
    /* Fondo y Tipografía */
    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
    }

    .portfolio-container {
        padding: 2rem;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        margin-top: 3rem;
    }

    .header-flex {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    /* Títulos */
    h1 {
        font-weight: 800;
        color: #2d3436;
        letter-spacing: -1px;
    }

    /* Tabla Estilizada */
    .custom-table {
        border-radius: 12px;
        overflow: hidden;
        border: none;
    }

    .custom-table thead {
        background-color: #4834d4;
        color: white;
    }

    .custom-table th {
        border: none;
        padding: 1.2rem;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 1px;
    }

    .custom-table td {
        vertical-align: middle;
        padding: 1rem;
        background: white;
    }

    .custom-table tbody tr:hover {
        background-color: #f9f9ff;
        transition: 0.3s;
    }

    /* Botones Modernos */
    .btn-custom {
        border-radius: 8px;
        padding: 0.5rem 1.2rem;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
    }

    .btn-create { background: #686de0; color: white; }
    .btn-create:hover { background: #4834d4; transform: translateY(-2px); color: white; }

    .btn-action {
        margin: 2px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    }

    .btn-action:hover {
        transform: scale(1.05);
    }

    /* Alertas */
    .alert-modern {
        border-radius: 12px;
        border: none;
        background: #00b894;
        color: white;
        font-weight: 500;
    }
</style>

<div class="container">
    <div class="portfolio-container">

        <div class="header-flex">
            <h1 class="fw-bold text-primary">📂 Portafolios</h1>
            @can('create', App\Models\Portfolio::class)
                <a href="{{ route('portfolios.create') }}" class="btn btn-custom btn-create">
                    <i class="fas fa-plus"></i> Nuevo Portafolio
                </a>
            @endcan
        </div>

        @if (session('success'))
            <div class="alert alert-modern alert-success animate__animated animate__fadeIn">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table custom-table">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($portfolios as $portfolio)
                        <tr>
                            <td class="fw-bold text-dark">{{ $portfolio->title }}</td>
                            <td class="text-muted">{{ Str::limit($portfolio->description, 60) }}</td>
                            <td class="text-center">
                                <a href="{{ route('portfolios.show', $portfolio->id) }}" class="btn btn-info btn-sm btn-custom btn-action dark:text-white">
                                    Ver
                                </a>
                                @can('update', $portfolio)
                                    <a href="{{ route('portfolios.edit', $portfolio->id) }}" class="btn btn-warning btn-sm btn-custom btn-action dark:text-white">
                                        Editar
                                    </a>
                                @endcan
                                @can('delete', $portfolio)
                                    <form action="{{ route('portfolios.destroy', $portfolio->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm btn-custom btn-action"
                                            onclick="return confirm('¿Seguro que deseas eliminar este portafolio?')">
                                            Eliminar
                                        </button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
