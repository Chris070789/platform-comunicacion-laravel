@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Post de {{ $post->user->name }}</h1>
        <p>{{ $post->content }}</p>

        @can('update', $post)
            <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning">Editar</a>
        @endcan

        @can('delete', $post)
            <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
        @endcan
    </div>
@endsection
