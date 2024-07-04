<!-- resources/views/messages/index.blade.php -->
@extends('layouts.app')

@section('title', 'Messages')

@section('content')
    <h1>Messages</h1>
    @foreach($conversations as $userId => $messages)
        <div>
            <h2>{{ $messages->first()->sender->name }}</h2>
            <p>{{ $messages->first()->content }}</p>
            <a href="{{ route('messages.show', $userId) }}">View Conversation</a>
        </div>
    @endforeach
@endsection