@extends('layouts.app')


@section('content')

<style>
    .ver-todas-notificacoes {
        display: block;
        margin-top: 10px;
        color: #007bff;
        text-decoration: none;
    }
    .ver-todas-notificacoes:hover {
        text-decoration: underline;
    }
</style>

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
        </div>
    </section>

    <section class="container w50 w100-device-small">
        <div class="wrap">

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
                              <input type="file" name="image" id="image" style="display:none" />
                              <label for="image" class="button"><i class="ri-image-add-line"></i></label>
                              <button type="submit"><i class="ri-send-plane-line"></i></button>
                          </div>
                      </form>
                        
                    </div>
                   
                </div>
            </section>

            <section class="items">
                @if(isset($posts) && count($posts) > 0)
                    @foreach ($posts as $post)
                        <x-content-post :post="$post" />
                    @endforeach
                @else
                    <p>No posts available.</p>
                @endif
 
                
                    
                        
                        
                       
                
                
            </section>

        </div>
    </section>

    <section class="container w20 w100-device-small">
        <div class="wrap">
            
            <section class="notifications margin-down-default">
                <div class="wrap">
                    <div class="box">
                        <p>NOTIFICATIONS</p>
                        {{--
                            
                            --}}
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
                        
                
                </div>
            </section>
            
        </div>
    </section>

</main>

@endsection