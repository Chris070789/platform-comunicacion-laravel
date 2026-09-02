@extends('layouts.app')

@section('content')
    <h2>Mensajes del grupo: {{ $chatGroup->name }}</h2>

    <div id="messages">
        @foreach ($chatGroup->messages as $message)
            <p><strong>{{ $message->user->name }}:</strong> {{ $message->message }}</p>
        @endforeach
    </div>

    <form id="chat-form">
        @csrf
        <input type="text" id="message" name="message" placeholder="Escribe un mensaje..." required>
        <button type="submit">Enviar</button>
    </form>
@endsection
