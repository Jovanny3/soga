!-- resources/views/posts/index.blade.php -->
@extends('layouts.app')

@section('title', 'Posts')

@section('content')
    <h1>Posts</h1>
    <a href="{{ route('posts.create') }}">Create New Post</a>
    @foreach($posts as $post)
        <div>
            <h2>{{ $post->user->name }}</h2>
            <p>{{ $post->content }}</p>
            @if($post->image)
                <img src="{{ Storage::url($post->image) }}" alt="Post Image">
            @endif
            <p>Likes: {{ $post->likes->count() }}</p>
            <form action="{{ route('posts.like', $post) }}" method="POST">
                @csrf
                <button type="submit">Like</button>
            </form>
            <h3>Comments</h3>
            @foreach($post->comments as $comment)
                <p>{{ $comment->user->name }}: {{ $comment->content }}</p>
            @endforeach
            <form action="{{ route('posts.comment', $post) }}" method="POST">
                @csrf
                <textarea name="content" required></textarea>
                <button type="submit">Comment</button>
            </form>
        </div>
    @endforeach
    {{ $posts->links() }}
@endsection