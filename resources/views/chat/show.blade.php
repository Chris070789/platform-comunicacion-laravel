@extends('layouts.app')

@section('content')
    <h3>Chat: {{ $chatGroup->name }}</h3>

    <div id="messages">
        @foreach ($chatGroup->messages as $message)
            <p><strong>{{ $message->user->name }}:</strong> {{ $message->message }}</p>
        @endforeach
    </div>

    {{-- Enviar mensaje --}}
    <form id="chat-form" method="POST">
        @csrf
        <input type="text" id="message" name="message" placeholder="Escribe un mensaje" required>
        <button type="submit">Enviar</button>
    </form>


    <script>
        document.getElementById('chat-form').addEventListener('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            fetch("{{ route('chat-groups.messages.store', $chatGroup->id) }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(res => {
                    if (!res.ok) {
                        return res.json().catch(() => {
                            throw new Error("Error inesperado en la respuesta");
                        }).then(err => {
                            throw new Error(JSON.stringify(err));
                        });
                    }
                    return res.json();
                })
                .then(data => {
                    console.log("Respuesta JSON:", data);
                    if (data.status === 'ok') {
                        let div = document.getElementById('messages');
                        let p = document.createElement('p');
                        let strong = document.createElement('strong');
                        strong.textContent = "{{ Auth::user()->name }}:";
                        p.appendChild(strong);
                        p.appendChild(document.createTextNode(" " + data.message.message));
                        div.appendChild(p);

                        document.getElementById('message').value = '';
                    }
                })
                .catch(err => {
                    console.error("Error recibido:", err.message);
                });
        });

        // Escuchar mensajes en tiempo real con Laravel Echo
        Echo.channel('chat.{{ $chatGroup->id }}')
            .listen('NewChatMessage', (e) => {
                let div = document.getElementById('messages');
                let p = document.createElement('p');
                let strong = document.createElement('strong');
                strong.textContent = e.user.name + ":";
                p.appendChild(strong);
                p.appendChild(document.createTextNode(" " + e.message));
                div.appendChild(p);
            });
    </script>
@endsection
