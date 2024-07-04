<!-- resources/views/layouts/app.blade.php 


    
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        {{--
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SOGA - @yield('title')</title>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo asset('css/global.css')?>" type="text/css">
        <link rel="stylesheet" href="<?php echo asset('css/style.css')?>" type="text/css">
    
    
    </head>
    <body>
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
    
                
                <li><a href="{{ route('profile.show') }}">Profile</a></li>
                <li><a href="{{ route('friends.index') }}">Friends</a></li>
                <li><a href="{{ route('posts.index') }}">Posts</a></li>
                <li><a href="{{ route('messages.index') }}">Messages</a></li>
                <li><a href="{{ route('notifications.index') }}">Notifications</a></li>
                <li><a href="{{ route('clubs.index') }}">Clubs</a></li>
                <li><a href="{{ route('events.index') }}">Events</a></li>
                <li><a href="{{ route('search.index') }}">Search</a></li> 
              
            </ul>
        </nav>
    
        <main>
            @yield('content')
        </main>
    
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
    </html> --}}
-->
{{--
    --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'socialNetwork') }}</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <link rel="stylesheet" href="{{asset('resources/css/app.css')}}"> 
   
</head>
<body>
    <header class="margin-down-small">
        <div class="wrap w90 center items-flex align-center just-space-between">
            <div class="col w30 items-flex align-center">
                <a href="{{ route('home') }}" class="logo"><i class="ri-zcool-line"></i></a>
                <form method="get" action="{{ route('search') }}" class="pos-relative items-flex align-baseline margin-left-default hide-device-small">
                    @csrf
                    <button type="submit" name="search"><i class="ri-search-line"></i></button>
                    <input type="text" name="query" placeholder="Search..." autocomplete="off" class="action-search" />
                   
                </form>
            </div>
            <ul class="col menu w30 items-flex just-center align-center hide-device-small">
                <li><a href="{{ route('home') }}"><i class="ri-home-4-line"></i></a></li>
                <li><a href="{{ route('new-group') }}"><i class="ri-add-circle-line"></i></a></li>
                <li><a href="{{ route('community') }}"><i class="ri-group-line"></i></a></li>
                <li><a href="https://github.com/jovannysavage3"><i class="ri-github-line"></i></a></li>
            </ul>
           
           @if(Auth::check())
    <ul class="col menu w30 menu items-flex just-center w90-device-small just-end-device-small">
        <li class="user box-effect-user">
            <a href="{{ route('profile', Auth::id()) }}">
                <figure class="img-user-small margin-right-small items-flex align-center">
                    <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('images/default-avatar.png') }}" alt="User avatar" />
                </figure>
                <h6>{{ Auth::user()->name }}</h6>
            </a>
        </li>
        <li class="hide-device-bigger"><a href="{{ route('profile', Auth::id()) }}"><i class="ri-user-line"></i></a></li>
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="button">
                    <i class="ri-logout-box-r-line"></i> Logout
                </button>
            </form>
        </li>
        <li><a href="http://api.whatsapp.com/send?1=pt_BR&phone=55{{ Auth::user()->phone_number ?? '' }}"><i class="ri-message-3-line"></i></a></li>
        <li class="hide-device-bigger"><a href="{{ route('community') }}"><i class="ri-group-line"></i></a></li>
        <li class="hide-device-bigger"><a href="{{ route('new-group') }}"><i class="ri-add-circle-line"></i></a></li>
        <li class="hide-device-bigger"><a href="{{ route('profile', Auth::id()) }}"><i class="ri-user-line"></i></a></li>
    </ul>
@else
    <ul class="col menu w30 menu items-flex just-center w90-device-small just-end-device-small">
        <li><a href="{{ route('login') }}">Login</a></li>
        <li><a href="{{ route('register') }}">Register</a></li>
    </ul>
@endif
           
           
           
           
           
           
           
           
           {{--}} <ul class="col menu w30 menu items-flex just-center w90-device-small just-end-device-small">
                <li class="user box-effect-user">

                    @if(Auth::check())
                        <a href="{{ route('profile', Auth::id()) }}">Perfil</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                    @endif

                   {{-- <a href="{{ route('profile', Auth::id()) }}"> 



                        <figure class="img-user-small margin-right-small items-flex align-center">
                            <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('images/default-avatar.png') }}" alt="User avatar" />
                        </figure>
                        <h6>{{ Auth::user()->name }}</h6>
                    </a>
                    
                </li>
                <li class="hide-device-bigger"><a href="{{ route('profile', Auth::id()) }}"><i class="ri-user-line"></i></a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="button">
                            <i class="ri-logout-box-r-line"></i> Logout
                        </button>
                    </form>
                </li>

                <li><a href="http://api.whatsapp.com/send?1=pt_BR&phone=55{{ Auth::user()->phone_number ?? '' }}"><i class="ri-message-3-line"></i></a></li>
               {{-- <li><a href="{{ route('notifications') }}"><i class="ri-notification-3-line"></i></a></li>-
                <li class="hide-device-bigger"><a href="{{ route('community') }}"><i class="ri-group-line"></i></a></li>
                <li class="hide-device-bigger"><a href="{{ route('new-group') }}"><i class="ri-add-circle-line"></i></a></li>
                <li class="hide-device-bigger"><a href="{{ route('profile', Auth::id()) }}"><i class="ri-user-line"></i></a></li>
            </ul>--}}
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="wrap items-flex align-center just-center">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </footer>

    

    <script src="{{asset('resources/js/app.js')}}"></script>  
</body>
</html>