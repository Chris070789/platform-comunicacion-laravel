@extends('layouts.app')

@section('content')
    <h3>Chat: {{ $chatGroup->name }}</h3>

    <div id="messages">
        @foreach ($chatGroup->messages as $message)
            <p><strong>{{ $message->user->name }}:</strong> {{ $message->message }}</p>
        @endforeach
    </div>

    {{-- Enviar mensaje --}}
    <form id="chat-form">
        @csrf
        <input type="text" id="message" placeholder="Escribe un mensaje">
        <button type="submit">Enviar</button>
    </form>

    <script>
        // Enviar mensaje vía AJAX
        document.getElementById('chat-form').addEventListener('submit', function(e) {
            e.preventDefault();
            fetch("{{ route('chat-groups.messages.store', $chatGroup->id) }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    message: document.getElementById('message').value
                })
            });
        });

        // Escuchar mensajes en tiempo real con Laravel Echo
        Echo.channel('chat.{{ $chatGroup->id }}')
            .listen('NewChatMessage', (e) => {
                let div = document.getElementById('messages');
                div.innerHTML += `<p><strong>${e.user.name}:</strong> ${e.message}</p>`;
            });
    </script>
@endsection
