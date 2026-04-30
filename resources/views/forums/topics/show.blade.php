@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $topic->title }}</h1>
        <p>Foro: {{ $forum->title }}</p>

        <h3>Posts en este tema</h3>
        <ul>
            @foreach ($topic->posts as $post)
                <li>
                    <p>{{ $post->content }}</p>
                    <small>por {{ $post->user->name }}</small>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
