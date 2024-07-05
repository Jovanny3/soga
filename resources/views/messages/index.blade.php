<!-- resources/views/messages/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Conversas</h2>
    <ul class="list-group">
        @foreach($users as $user)
            <li class="list-group-item">
                <a href="{{ route('messages.show', $user->id) }}">{{ $user->name }}</a>
            </li>
        @endforeach
    </ul>
</div>
@endsection