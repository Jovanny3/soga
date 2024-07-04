<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Like;

class LikeController extends Controller
{
    public function store(Post $post)
    {
        $user = Auth::user();

        // Verifica se o usuário já curtiu o post
        $existingLike = Like::where('user_id', $user->id)
                            ->where('post_id', $post->id)
                            ->first();

        if ($existingLike) {
            // Se já curtiu, remove a curtida
            $existingLike->delete();
            $action = 'unliked';
        } else {
            // Se não curtiu, adiciona a curtida
            Like::create([
                'user_id' => $user->id,
                'post_id' => $post->id
            ]);
            $action = 'liked';
        }

        // Retorna o número atualizado de curtidas
        $likeCount = $post->likes()->count();

        if (request()->ajax()) {
            return response()->json([
                'action' => $action,
                'likeCount' => $likeCount
            ]);
        }

        return redirect()->back()->with('success', "Post $action successfully");
    }

    public function index(Post $post)
    {
        $likes = $post->likes()->with('user')->paginate(20);
        return view('likes.index', compact('post', 'likes'));
    }
}
?>