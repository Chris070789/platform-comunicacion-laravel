@extends('layouts.app')

@section('content')
    <h2>Chat grupal</h2>

    {{-- Crear grupo de chat --}}
    <form action="{{ route('chat-groups.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Nombre del grupo">
        <button type="submit">Crear grupo</button>
    </form>

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
