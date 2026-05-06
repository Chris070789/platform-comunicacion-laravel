@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6 max-w-4xl h-[calc(100vh-120px)] flex flex-col">

        {{-- Cabecera del Chat --}}
        <div
            class="bg-white dark:bg-gray-800 p-4 rounded-t-2xl border-b dark:border-gray-700 shadow-sm flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('chat-groups.index') }}" class="text-gray-500 hover:text-gray-700 dark:text-gray-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white leading-tight">{{ $chatGroup->name }}</h3>
                    <span class="text-xs text-green-500 flex items-center gap-1">
                        <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span> En vivo
                    </span>
                </div>
            </div>
        </div>

        {{-- Contenedor de Mensajes --}}
        <div id="messages"
            class="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50 dark:bg-gray-900/50 scrollbar-thin scrollbar-thumb-gray-300 dark:scrollbar-thumb-gray-700">
            @foreach ($chatGroup->messages as $message)
                <div class="flex {{ $message->user_id == Auth::id() ? 'justify-end' : 'justify-start' }}">
                    <div
                        class="max-w-[75%] {{ $message->user_id == Auth::id() ? 'bg-green-600 text-white rounded-l-2xl rounded-tr-2xl shadow-blue-200' : 'bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 rounded-r-2xl rounded-tl-2xl border border-gray-100 dark:border-gray-700 shadow-sm' }} px-4 py-2">
                        @if ($message->user_id != Auth::id())
                            <p class="text-[10px] font-bold uppercase mb-1 opacity-70">{{ $message->user->name }}</p>
                        @endif
                        <p class="text-sm leading-relaxed">{{ $message->message }}</p>
                        <p class="text-[9px] mt-1 text-right opacity-60">
                            {{ $message->created_at->format('H:i') }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Formulario de Envío --}}
        <div class="bg-white dark:bg-gray-800 p-4 rounded-b-2xl border-t dark:border-gray-700 shadow-lg">
            <form id="chat-form" method="POST" class="flex gap-2 items-center">
                @csrf
                <div class="relative flex-1">
                    <input type="text" id="message" name="message" placeholder="Escribe un mensaje..." required
                        class="w-full pl-4 pr-12 py-3 rounded-full border-gray-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500 transition-all shadow-sm text-sm">
                </div>
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white p-3 rounded-full transition-all transform active:scale-90 shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                </button>
            </form>
        </div>
    </div>

    <script>
        // Función para scroll automático al final
        const scrollToBottom = () => {
            const messagesDiv = document.getElementById('messages');
            messagesDiv.scrollTop = messagesDiv.scrollHeight;
        };

        // Ejecutar al cargar
        scrollToBottom();

        document.getElementById('chat-form').addEventListener('submit', function(e) {
            e.preventDefault();
            let input = document.getElementById('message');
            let messageText = input.value;
            let formData = new FormData(this);

            // Limpieza inmediata del input para mejor UX
            input.value = '';

            fetch("{{ route('chat-groups.messages.store', $chatGroup->id) }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'ok') {
                        appendMessage("{{ Auth::user()->name }}", data.message.message, true);
                    }
                });
        });

        // Escuchar con Echo
        Echo.channel('chat.{{ $chatGroup->id }}')
            .listen('NewChatMessage', (e) => {
                if (e.user.id != "{{ Auth::id() }}") { // Evitar duplicar si ya lo agregaste localmente
                    appendMessage(e.user.name, e.message, false);
                }
            });

        function appendMessage(userName, message, isOwn) {
            let div = document.getElementById('messages');
            let wrapper = document.createElement('div');
            wrapper.className = `flex ${isOwn ? 'justify-end' : 'justify-start'}`;

            let now = new Date().toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit'
            });

            wrapper.innerHTML = `
            <div class="max-w-[75%] ${isOwn ? 'bg-green-600 text-white rounded-l-2xl rounded-tr-2xl shadow-blue-200' : 'bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 rounded-r-2xl rounded-tl-2xl border border-gray-100 dark:border-gray-700 shadow-sm'} px-4 py-2">
                ${!isOwn ? `<p class="text-[10px] font-bold uppercase mb-1 opacity-70">${userName}</p>` : ''}
                <p class="text-sm leading-relaxed">${message}</p>
                <p class="text-[9px] mt-1 text-right opacity-60">${now}</p>
            </div>
        `;

            div.appendChild(wrapper);
            scrollToBottom();
        }
    </script>

    <style>
        /* Ocultar scrollbar pero mantener funcionalidad */
        .scrollbar-thin::-webkit-scrollbar {
            width: 4px;
        }

        .scrollbar-thin::-webkit-scrollbar-track {
            background: transparent;
        }

        .scrollbar-thin::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }

        .scrollbar-thin::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
@endsection
