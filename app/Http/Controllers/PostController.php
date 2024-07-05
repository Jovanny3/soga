<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Illuminate\Support\Str;

use App\Models\Comment;

// app/Http/Controllers/PostController.php
class PostController extends Controller

{



    public function index()
{
    $posts = Post::with('user')->get();
    $comments = Comment::with('user')->get();
    return view('home', compact('posts', 'comments'));
}
     public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageName = Str::slug($data['title']) . '.' . $request->image->extension();
            $imagePath = $request->image->storeAs('posts', $imageName, 'public');
            $data['image'] = $imagePath;
        }

        $data['user'] = Auth::id();

        $post = Post::create($data);

        return redirect()->route('home')->with('success', 'Post created successfully');
    }
}