<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Club;
use App\Models\Event;

class SearchController extends Controller
{
   
     public function index(Request $request)
    {
        $query = $request->input('query');
        $users = User::where('name', 'like', "%$query%")->paginate(20);
        $posts = Post::where('content', 'like', "%$query%")->paginate(20);
        $clubs = Club::where('name', 'like', "%$query%")->paginate(20);
        $events = Event::where('name', 'like', "%$query%")->paginate(20);
        
        return view('search.index', compact('users', 'posts', 'clubs', 'events', 'query'));
    }

}
