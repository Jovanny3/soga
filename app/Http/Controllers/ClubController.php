<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Club;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;


// app/Http/Controllers/ClubController.php
class ClubController extends Controller
{
   public function participateInTheCommunity(Request $request, $id)
    {
        $community = Club::findOrFail($id);
        
        $community->users()->syncWithoutDetaching($request->users);

        return redirect()->route('home')->with('success', 'Joined community successfully');
    }

    public function createNewCommunity(Request $request)
    {
        $data = $request->validate([
            'name_community' => 'required|string|unique:clubs,name_community',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageName = Str::slug($data['name_community']) . '.' . $request->image->extension();
            $imagePath = $request->image->storeAs('groups', $imageName, 'public');
            $data['image'] = $imagePath;
        }

        $community = Club::create($data);

        return redirect()->route('new-group', $community)->with('success', 'Community created successfully');
    }

    public function getCommunitys($id)
    {
        $group = Club::findOrFail($id);
        $posts = Post::all();
        $comments = Comment::all();
        $users = User::all();

        return view('clubs.group', compact('group', 'posts', 'users', 'comments'));
    }

    public function newGroup()
    {
        $users = User::all();
        return view('clubs.new-group', compact('users'));
    }
}