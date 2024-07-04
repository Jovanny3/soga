<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
class CommentController extends Controller
{
    //

    public function store(Request $request)
    {
        $data = $request->validate([
            'content' => 'required|string',
            'post_id' => 'required|exists:posts,id',
        ]);

        $data['user_id'] = Auth::id();

        $comment = Comment::create($data);

        return redirect()->route('home')->with('success', 'Comment added successfully');
    }
}