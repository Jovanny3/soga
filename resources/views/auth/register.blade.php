<!-- resources/views/auth/register.blade.php -->
@extends('layouts.app')

@section('title', 'Register')


<section class="container-access items-flex just-center align-center">
    <div class="wrap w50 center w90-device-small">
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="box-access items-flex flex-wrap align-center just-center">
            @csrf
            <div>
                <label for="name">Name</label>
                <input type="text" name="name" required autofocus :value="old('name')" />
                
            </div>
            
             
                <label for="name">email</label>
                <input type="text" name="email" required autofocus :value="old('email')" />
            
            
                <label for="name">image</label>
                 <input type="file" name="image" :value="old('image')" />
            
            
                <label for="name">Password</label>
                <input type="password" name="password" autofocus required autocomplete="new-password" />
            
                <label for="name">Confirm Password</label>
                <input type="password" name="password_confirmation" autofocus required autocomplete="password_confirmation" />
            
            
            
           
            

            <button class="bgBlackWeakIn w30">{{ __('Register') }}</button>
            <a class="w100 text-right" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
        </form>
    </div>
</section>

@section('content')
    <h1>Register</h1>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div>
            
            <input type="text" name="name" id="name" required>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div>
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required>
        </div>
        <button type="submit">Register</button>
    </form>
@endsection