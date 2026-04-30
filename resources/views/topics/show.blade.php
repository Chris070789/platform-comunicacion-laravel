@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $topic->title }}</h1>
        <p>{{ $topic->content }}</p>

        <h3>Posts</h3>
        <ul>
            @foreach ($topic->posts as $post)
                <li>
                    <a href="{{ route('posts.show', $post) }}">
                        {{ Str::limit($post->content, 50) }}
                    </a>
                </li>
            @endforeach
        </ul>

        @can('create-post', $topic)
            <a href="{{ route('posts.create', $topic) }}" class="btn btn-primary">Agregar post</a>
        @endcan
    </div>
@endsection
