<!-- resources/views/events/index.blade.php -->
@extends('layouts.app')

@section('title', 'Events')

@section('content')
    <h1>Events</h1>
    <a href="{{ route('events.create') }}">Create New Event</a>
    @foreach($events as $event)
        <div>
            <h2>{{ $event->name }}</h2>
            <p>{{ $event->description }}</p>
            <p>Date: {{ $event->date }}</p>
            <a href="{{ route('events.show', $event) }}">View Event</a>
        </div>
    @endforeach
    {{ $events->links() }}
@endsection