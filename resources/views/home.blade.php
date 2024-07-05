@extends('layouts.app')


@section('content')



<main class="items-flex w90 center just-space-between w95-device-small">
    
    <section class="container-menu w20 w100-device-small container-order">
        <div class="wrap items-flex just-space-between">
            <div class="row w100">
                <div class="item text-center margin-down-small">
                    <figure class="box-banner margin-down-small-in">
                        <img src="{{ asset('storage/images/bannerAccess.jpg') }}" />
                    </figure>
                    <h6>Seja bem vindo(a) {{ Auth::user()?->name ?? 'Visitante' }}</h6>
                </div>
                <div class="item-margin-down-small">
                   
                   
                    @if(isset($communities))
                        @foreach($communities as $group)
                            <div class="margin-down-small">
                                <a href="{{ route('group', $group->id) }}">
                                    <figure class="box-banner margin-down-small-in">
                                      <img src="{{ $group->image ? asset('storage/' . $group->image) : asset('storage/posts/hello-world.png') }}" alt="{{ $group->name_community }}" />
                                    </figure>
                                    <h5>{{ $group->name_community }}</h5>
                                </a>
                            </div>
                        @endforeach
    
                    @endif


                </div>
            </div>
        </div>
        
    </section>

    <section class="container w50 w100-device-small">
        

            <section class="margin-down-default">
                <div class="title margin-down-small">
                    <h3>New Users</h3>
                </div>
                <div class="slide">
                    
                    @if(isset($newUsers) && count($newUsers) > 0)
                        @foreach($newUsers as $user)
                            <div class="user-item">
                                <figure class="img-user-small">
                                    <img src="{{ $user->image ? asset('storage/' . $user->image) : asset('images/default-avatar.png') }}" alt="{{ $user->name }}'s avatar" />
                                </figure>
                                <h6>{{ $user->name }}</h6>
                            </div>
                        @endforeach
                    @else
                        <p>No new users at the moment.</p>
                    @endif
                </div>



            </section>

            <section class="margin-down-small">
                <h3>Feed</h3>
            </section>

            <!-- Formulário de criação de post (mantido como estava) -->

            <!-- Lista de posts -->
                <section class="posts-container">
                        @foreach($posts as $post)
                            <div class="post-header">
                                <!-- Conteúdo do post (mantido como estava) -->
                                <div class="postcard">

                                    <div class="user-info">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="user-info d-flex align-items-center">
                                            {{--} <img src="{{ $post->user->image ? asset('storage/' . $post->user->image) : asset('images/default-avatar.png') }}" 
                                            alt="{{ $post->user->name }}" class="rounded-circle mr-2" style="width: 40px; height: 40px;">--}}
                                            {{--}} <span class="user-name">{{ $post->user->name }}</span>--}}
                                        </div>
                                        <small class="post-time">{{ $post->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            <div class="post-body">
                                <h5 class="post-title">{{ $post->title }}</h5>
                                <p class="post-text">{{ $post->content }}</p>
                                @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" alt="Post image" class="post-image">
                                @endif
                            </div>
                            <div class="post-actions d-flex justify-content-between">
                                <button class="btn btn-light like-btn" data-post-id="{{ $post->id }}">
                                    <i class="ri-thumb-up-line"></i><span class="like-count">{{ $post->likes_count }}</span>
                                </button>
                                <button class="btn btn-light comment-btn" data-post-id="{{ $post->id }}">
                                    <i class="fa fa-comment"></i> Comentar
                                </button>
                            </div>  
                            
                            <div class="card-footer">
                                <div class="comments-container" id="comments-{{ $post->id }}">
                                    @foreach($post->comments as $comment)
                                        <div class="comment mb-2">
                                            <strong>{{ $comment->user->name }}</strong>: {{ $comment->content }}
                                        </div>
                                    @endforeach
                                </div>
                                <form class="comment-form" data-post-id="{{ $post->id }}">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Adicione um comentário...">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="submit">Enviar</button>
                                            </div>
                                    </div>
                                </form>

                            
                            </div>
                        @endforeach
                

                        <!-- Paginação -->
                    @if(method_exists($posts, 'hasPages') && $posts->hasPages())
                        <div class="pagination">
                            {{ $posts->links() }}
                            <button id="load-more" class="btn btn-primary" data-page="{{ $posts->currentPage() + 1 }}">
                                Carregar mais
                            </button>
                        </div>
                    @endif
                </section>

            <section class="container-form margin-down-small">
                <div class="row items-flex">

                        <figure class="img-user-default margin-right-small items-flex align-baseline">
                          {{--<img src="{{ Auth::user()->image ?? 'foto' ? asset('storage/' . Auth::user()->image) : asset('images/default-avatar.png') }}" alt="{{ Auth::user()->name }}'s avatar" />--}}

                            <img src="{{ Auth::check() && Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('images/default-avatar.png') }}" 
                                alt="{{ Auth::check() ? Auth::user()->name . '\'s avatar' : 'Default avatar' }}" />

                        </figure>
                        <form class="new-post w100 pos-relative" method="post" action="{{ route('store') }}" enctype="multipart/form-data">
                          @csrf
                          <input type="text" name="title" placeholder="New post" class="w100" />
                          <textarea class="text-content hide" name="content" placeholder="Hello World"></textarea>
                          <div class="buttons items-flex">
                              <a class="button toggle"><i class="ri-text"></i></a>
                              {{--<a href="{{ route('criar-postagem') }}" class="btn btn-primary">Criar Nova Postagem</a>--}}
                              <input type="file" name="image" id="image" style="display:none" />
                              <label for="image" class="button"><i class="ri-image-add-line"></i></label>
                              <button type="submit"><i class="ri-send-plane-line"></i></button>
                          </div>
                        </form>
                        
                    </div>
                   
                </div>
            </section>

            
            
            
            

        


        @section('scripts')
            <script>
                $(document).ready(function() {
                // Lógica para curtir post
                    $('.like-btn').click(function() {
                        let postId = $(this).data('post-id');
                        $.post(`/posts/${postId}/like`, function(response) {
                            // Atualizar contagem de curtidas
                        });
                    });

                    // Lógica para enviar comentário
                    $('.comment-form').submit(function(e) {
                        e.preventDefault();
                        let postId = $(this).data('post-id');
                        let content = $(this).find('input').val();
                        $.post(`/posts/${postId}/comment`, { content: content }, function(response) {
                            // Adicionar novo comentário à lista
                        });
                    });

                    // Lógica para carregar mais posts
                    $('#load-more').click(function() {
                        let nextPage = $(this).data('page');
                        $.get(`/posts?page=${nextPage}`, function(response) {
                            // Adicionar novos posts à lista e atualizar botão
                        });
                    });
                });
            </script>
        @endsection
    </section>

    <section class="container w20 w100-device-small">
            <section class="notifications margin-down-default">
                    <div class="box">
                        <p>NOTIFICATIONS</p>
                        <a href="{{ route('notifications') }}" class="ver-todas-notificacoes">Ver Todas as Notificações</a>
                        @if(isset($friendRequests))
                            @foreach($friendRequests as $friendRequest)
                                    @if($friendRequest->user_to == Auth::id() && $friendRequest->status == 'pending')
                                        <div class="items-flex margin-top-small align-center">
                                            <figure class="img-user-small margin-right-small items-flex align-center">
                                                <img src="{{ $friendRequest->sender->image ? asset('storage/' . $friendRequest->sender->image) : asset('images/default-avatar.png') }}" alt="{{ $friendRequest->sender->name }}'s avatar" />
                                            </figure>
                                            <h6>{{ $friendRequest->sender->name }} asked to be your friend</h6>
                                        </div>
                                    @endif
                                @endforeach
                                @foreach($posts as $post)
                                    @if($post->created_at->isToday())
                                        <div class="items-flex margin-top-small align-center">
                                            <figure class="img-user-small margin-right-small items-flex align-center">
                                                <img src="{{ $post->image ? asset('storage/' . $post->image) : asset('images/default-post.png') }}" alt="Post image" />
                                            </figure>
                                            <h6>New post: {{ $post->title }}</h6>
                                        </div>
                                    @endif
                                @endforeach
                        @endif    
                    </div> 
            </section>

            <section class="users">
                <div class="wrap">
                    <p>Friends</p>
                        <ul class="margin-top-small">

                            @if(isset($friendRequests))
                                @foreach ($friendRequests as $friendRequest)
                                    @if($friendRequest->status == 'approved' && ($friendRequest->user_from == Auth::id() || $friendRequest->user_to == Auth::id()))
                                        @php
                                            $friend = $friendRequest->user_from == Auth::id() ? $friendRequest->receiver : $friendRequest->sender;
                                        @endphp
                                        <li class="items-flex align-center margin-down-small">
                                            <figure class="img-user-default margin-right-small items-flex align-center">
                                                <img src="{{ $friend->image ? asset('storage/' . $friend->image) : asset('images/default-avatar.png') }}" alt="{{ $friend->name }}'s avatar" />
                                            </figure>
                                            <h6>{{ $friend->name }}</h6>
                                        </li>
                                    @endif
                                @endforeach  
                            @endif
                        </ul>
    </section>
{{--
    
    -}}
            <section class="chat-container">
    <h3>Chat</h3>
    <div id="chat-messages"></div>
    <form id="chat-form">
        <input type="text" id="chat-input" placeholder="Digite sua mensagem...">
        <button type="submit">Enviar</button>
    </form>
</section>

@section('scripts')
<script src="{{ asset('js/app.js') }}"></script>
<script>
    // Configurar o Axios para incluir o CSRF token em todas as requisições
    axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const userId = {{ Auth::id() }};
    const chatMessages = document.getElementById('chat-messages');
    const chatForm = document.getElementById('chat-form');
    const chatInput = document.getElementById('chat-input');

    Echo.private(`chat.${userId}`)
        .listen('NewMessage', (e) => {
            appendMessage(e.message);
        });

    chatForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const content = chatInput.value;
        if (content) {
            axios.post('{{ route("messages.store") }}', {
                content: content,
                receiver_id: receiverId // ID do usuário com quem está conversando
            })
            .then(response => {
                appendMessage(response.data);
                chatInput.value = '';
            })
            .catch(error => console.error(error));
        }
    });

    function appendMessage(message) {
        const messageElement = document.createElement('div');
        messageElement.textContent = `${message.sender_id}: ${message.content}`;
        chatMessages.appendChild(messageElement);
    }

    // Carregar mensagens anteriores
    axios.get(`{{ route("messages.get", "") }}/${receiverId}`)
        .then(response => {
            response.data.forEach(message => appendMessage(message));
        })
        .catch(error => console.error(error));
</script>
@endsection
            
        </div>
    </section>
--}}
</main>

@endsection