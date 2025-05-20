@extends('layouts.app')

@section('content')
<style>
    .chat-wrapper {
        display: flex;
        gap: 20px;
        max-height: 600px;
        height: 600px; /* fijo para mejor control */
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Chat y panel info con proporciones similares */
    #chat-section,
    #info-section {
        flex: 1; /* ocupan igual espacio */
        display: flex;
        flex-direction: column;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        background-color: #fff;
        padding: 15px;
        overflow: hidden;
    }

    #chat-section {
        background-color: #e5ddd5;
    }

    #chat-section h2,
    #info-section h3 {
        margin: 0 0 15px 0;
        font-weight: 600;
        color: #202c33;
    }

    #chat-container {
        flex-grow: 1;
        overflow-y: auto;
        padding: 12px;
        border-radius: 10px;
        box-shadow: inset 0 0 8px rgba(0,0,0,0.1);
        display: flex;
        flex-direction: column;
        font-size: 12px;
    }

    .message {
        max-width: 75%;
        padding: 8px 20px;
        margin-bottom: 8px;
        border-radius: 14px;
        position: relative;
        line-height: 1.2;
        font-size: 12px;
        word-wrap: break-word;
        white-space: pre-wrap;
        box-shadow: 0 2px 5px rgba(0,0,0,0.08);
    }

    .message.client {
        background-color: #fff;
        color: #202c33;
        border-bottom-left-radius: 3px;
        align-self: flex-start;
    }

    .message.admin {
        background-color: #dcf8c6;
        color: #303030;
        border-bottom-right-radius: 3px;
        align-self: flex-end;
    }

    .timestamp {
        font-size: 9px;
        margin-top: 3px;
        color: #666;
    }

    #chat-form {
        display: flex;
        gap: 8px;
        margin-top: 10px;
        align-items: center;
    }

    #message {
        flex-grow: 1;
        resize: none;
        border-radius: 18px;
        padding: 8px 12px;
        font-size: 13px;
        border: 1px solid #ccc;
        box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
        transition: border-color 0.2s ease;
        height: 36px;
        line-height: 1.2;
        font-family: inherit;
    }

    #message:focus {
        outline: none;
        border-color: #4caf50;
        box-shadow: 0 0 5px #4caf50;
    }

    #send-button {
        background-color: #4caf50;
        border: none;
        color: white;
        padding: 0 16px;
        border-radius: 18px;
        cursor: pointer;
        font-weight: 600;
        font-size: 13px;
        transition: background-color 0.3s ease;
        height: 36px;
    }

    #send-button:hover {
        background-color: #45a049;
    }

    #notification {
        padding: 6px 12px;
        font-size: 0.9rem;
        margin-bottom: 8px;
    }

    /* Info cliente */
    #info-section p {
        margin: 8px 0;
        color: #555;
        font-size: 14px;
        line-height: 1.3;
    }

</style>

<div class="container py-4 chat-wrapper">
    <!-- Chat a la izquierda -->
    <section id="chat-section">
        

        <div id="notification" class="alert alert-success d-none" role="alert">
            Nuevo mensaje recibido
        </div>

        <div id="chat-container" class="d-flex flex-column">
            @foreach($messages as $msg)
                <div data-id="{{ $msg->id }}" class="message {{ $msg->from_admin ? 'admin' : 'client' }}">
                    {!! nl2br(e($msg->message)) !!}
                    <div class="timestamp">{{ $msg->created_at->format('H:i') }}</div>
                </div>
            @endforeach
        </div>

        <form id="chat-form" autocomplete="off">
            @csrf
            <textarea name="message" id="message" rows="1" placeholder="Escribe un mensaje..." required></textarea>
            <button type="submit" id="send-button" aria-label="Enviar mensaje">Enviar</button>
        </form>
    </section>

    <!-- Información del cliente a la derecha -->
    <aside id="info-section">
        <h3>Información del Cliente</h3>
        <p><strong>Tipo de documento:</strong> {{ $cliente->tipo_documento ?? 'No disponible' }}</p>
        <p><strong>Identificación:</strong> {{ $cliente->numero_documento ?? 'No disponible' }}</p>
        <p><strong>Nombre:</strong> {{ $cliente->nombres ?? 'No disponible' }}</p>
        <p><strong>Apellido:</strong> {{ $cliente->apellidos ?? 'No disponible' }}</p>
        <p><strong>Email:</strong> {{ $cliente->correo ?? 'No disponible' }}</p>
        <p><strong>Teléfono:</strong> {{ $cliente->telefono ?? 'No disponible' }}</p>
        <!-- Más campos si quieres -->
    </aside>
</div>

<meta name="csrf-token" content="{{ csrf_token() }}" />

<script>
    const usuario = @json($usuario);
    let lastId = @json($lastId);

    function addMessages(messages) {
        const container = document.getElementById('chat-container');
        messages.forEach(msg => {
            if (document.querySelector(`[data-id='${msg.id}']`)) return;

            const div = document.createElement('div');
            div.setAttribute('data-id', msg.id);
            div.className = 'message ' + (msg.from_admin ? 'admin' : 'client');
            div.innerHTML = `
                ${msg.message.replace(/\n/g, '<br>')}
                <div class="timestamp">${new Date(msg.created_at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</div>
            `;

            container.appendChild(div);
            container.scrollTop = container.scrollHeight;
        });

        if (messages.length > 0) {
            lastId = messages[messages.length - 1].id;

            const notification = document.getElementById('notification');
            notification.classList.remove('d-none');
            setTimeout(() => {
                notification.classList.add('d-none');
            }, 2000);
        }
    }

    setInterval(() => {
        fetch(`/admin/chat/${usuario}/messages?last_id=${lastId}`)
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    addMessages(data);
                }
            })
            .catch(console.error);
    }, 3000);

    document.getElementById('chat-form').addEventListener('submit', function(e) {
        e.preventDefault();

        const messageInput = document.getElementById('message');
        const message = messageInput.value.trim();
        if (!message) return;

        fetch(`/admin/chat/${usuario}/send`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ message })
        })
        .then(response => {
            if (!response.ok) throw new Error('Error al enviar mensaje');
            return response.json();
        })
        .then(data => {
            messageInput.value = '';
            addMessages([data.message]);
        })
        .catch(error => alert(error.message));
    });
</script>
@endsection
