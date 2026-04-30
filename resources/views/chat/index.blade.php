@extends('layouts.app')

@section('content')
    <h2>Chat grupal</h2>

    {{-- Crear grupo de chat --}}
    @role('docente')
        <form action="{{ route('chat-groups.store') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Nombre del grupo">
            <button type="submit">Crear grupo</button>
        </form>
    @endrole

    @role('alumno')
        {{-- Los alumnos no pueden crear grupos, solo participar --}}
        <p>No tienes permisos para crear grupos de chat. Puedes participar en los existentes.</p>
    @endrole

    {{-- Listado de grupos --}}
    <ul>
        @foreach ($groups as $group)
            <li>
                <a href="{{ route('chat-groups.show', $group->id) }}">
                    {{ $group->name }}
                </a>
            </li>
        @endforeach
    </ul>
@endsection
