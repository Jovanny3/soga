
@extends('layouts.app')

@section('content')


<div class="container">
    <h2>Conversa com {{ $user->name }}</h2>
    <div id="chat-messages" class="mb-3">
        @foreach($messages as $message)
            <div class="message {{ $message->sender_id == auth()->id() ? 'text-right' : 'text-left' }}">
                <strong>{{ $message->sender_id == auth()->id() ? 'Você' : $user->name }}:</strong>
                {{ $message->content }}
            </div>
        @endforeach
    </div>
    <form id="chat-form">
        @csrf
        <div class="form-group">
            <input type="text" id="chat-input" class="form-control" placeholder="Digite sua mensagem...">
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/app.js') }}"></script>
<script>
    axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const userId = {{ Auth::id() }};
    const receiverId = {{ $user->id }};
    const chatMessages = document.getElementById('chat-messages');
    const chatForm = document.getElementById('chat-form');
    const chatInput = document.getElementById('chat-input');

    Echo.private(`chat.${userId}`)
        .listen('NewMessage', (e) => {
            if (e.message.sender_id == receiverId) {
                appendMessage(e.message);
            }
        });

    chatForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const content = chatInput.value;
        if (content) {
            axios.post('{{ route("messages.store") }}', {
                content: content,
                receiver_id: receiverId
            })
            .then(response => {
                appendMessage(response.data);
                chatInput.value = '';
            })
            .catch(error => {
                console.error(error);
                if (error.response) {
                    // O servidor respondeu com um status de erro
                    alert('Erro ao enviar mensagem: ' + error.response.data.message);
                } else {
                    alert('Erro ao enviar mensagem. Por favor, tente novamente.');
                }
            });
        }
    });

    function appendMessage(message) {
        const messageElement = document.createElement('div');
        messageElement.className = `message ${message.sender_id == userId ? 'text-right' : 'text-left'}`;
        messageElement.innerHTML = `<strong>${message.sender_id == userId ? 'Você' : '{{ $user->name }}'}:</strong> ${message.content}`;
        chatMessages.appendChild(messageElement);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }
</script>
@endsection