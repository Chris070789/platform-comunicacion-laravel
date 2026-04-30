@extends('layouts.app')

@section('content')
    <h1>Foros</h1>
    {{-- Crear foro --}}
    @role('docente')
        <form action="{{ route('forums.store') }}" method="POST">
            @csrf
            <input type="text" name="title" placeholder="Nombre del foro">
            <button type="submit">Crear foro</button>
        </form>
    @endrole

    @role('alumno')
        {{-- Los alumnos no pueden crear foros, solo verlos --}}
        <p>No tienes permisos para crear foros. Puedes participar en los existentes.</p>
    @endrole

    {{-- Listado de foros --}}
    <ul>
        @foreach ($forums as $forum)
            <li>
                <a href="{{ route('forums.topics.index', $forum->id) }}">
                    {{ $forum->title }}
                </a>
            </li>
        @endforeach
    </ul>
@endsection
