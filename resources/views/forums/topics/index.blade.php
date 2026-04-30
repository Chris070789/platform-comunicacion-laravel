@extends('layouts.app')

@section('content')
    <h2>Temas en {{ $forum->title }}</h2>

    {{-- Crear tema --}}
    <form action="{{ route('forums.topics.store', $forum->id) }}" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Título del tema">
        <button type="submit">Crear tema</button>
    </form>

    {{-- Listado de temas --}}
    <ul>
        @foreach ($topics as $topic)
            <li>
                <a href="{{ route('topics.posts.index', $topic->id) }}">
                    {{ $topic->title }} (por {{ $topic->user->name }})
                </a>
            </li>
        @endforeach
    </ul>
@endsection
