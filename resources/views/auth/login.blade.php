<!-- resources/views/auth/login.blade.php -->
@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <h1>Login</h1>


 


<section class="container-access items-flex just-center align-center">
    <div class="wrap w50 center w90-device-small">
        <form method="POST" action="{{ route('login') }}" class="box-access items-flex flex-wrap align-center just-center">
           
            @csrf
            <input type="text" name="email" required autofocus :value="old('email')" />
            <input type="password" name="password" required autocomplete="current-password" />
            <div class="w100 margin-down-small items-flex align-center">
                <input id="remember_me" type="checkbox" class="margin-right-small" name="remember">
                <span><h6>{{ __('Remember me') }}</h6></span>
            </div>
            <button class="bgBlackWeakIn w30 margin-down-small-device-small">{{ __('Log in') }}</button>
            @if (Route::has('password.request'))
                <a class="w100 text-right" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </form>
    </div>
</section>




    <form id="form" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="email">
            <label  for="email">Email</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div id="pass">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>
        <button type="submit">Login</button>
    </form>
@endsection