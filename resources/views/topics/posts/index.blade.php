@extends('layouts.app')

@section('content')
    <h3>{{ $topic->title }}</h3>

    {{-- Responder --}}
    <form action="{{ route('topics.posts.store', $topic->id) }}" method="POST">
        @csrf
        <textarea name="content" placeholder="Escribe tu respuesta"></textarea>
        <button type="submit">Enviar</button>
    </form>

    {{-- Listado de posts --}}
    <ul>
        @foreach ($posts as $post)
            <li>
                <strong>{{ $post->user->name }}:</strong> {{ $post->content }}
            </li>
        @endforeach
    </ul>
@endsection
