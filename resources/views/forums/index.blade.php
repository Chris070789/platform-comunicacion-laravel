@extends('layouts.app')

@section('content')
    <h1>Foros</h1>

    {{-- Crear foro --}}
    <form action="{{ route('forums.store') }}" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Nombre del foro">
        <button type="submit">Crear foro</button>
    </form>

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
