@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $forum->title }}</h1>
        <p>{{ $forum->description }}</p>

        <h3>Temas en este foro</h3>
        <ul>
            @foreach ($forum->topics as $topic)
                <li>
                    <a href="{{ route('forums.topics.show', [$forum, $topic]) }}">
                        {{ $topic->title }}
                    </a>
                </li>
            @endforeach
        </ul>

        @can('create', App\Models\Topic::class)
            <a href="{{ route('forums.topics.create', $forum) }}" class="btn btn-primary">Crear nuevo tema</a>
        @endcan
    </div>
@endsection
