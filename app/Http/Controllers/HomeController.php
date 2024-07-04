<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Friends;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\models\Post;
use App\Models\User;
use App\Models\Profile;


class HomeController extends Controller
{
    // app/Http/Controllers/HomeController.php
    public function __construct()
{
    $this->middleware('Auth');
}
    public function index()
    {
        
      

        $clubs = Club::all(); 

        $posts = Post::with(['user', 'likes', 'comments'])->latest()->take(10)->get();

        // Comunidades
        $clubs = Club::all();

        // Últimos usuários (para a seção "New Users")
        $lastUsers = User::latest()->take(5)->get();

        // Solicitações de amizade
        $friendRequests = Friends::where('user_to', Auth::id())
            ->orWhere('user_from', Auth::id())
            ->with(['sender', 'receiver'])
            ->get();

       

        return view('home', compact('posts', 'communities', 'lastUsers', 'friendRequests', 'clubs'));
    }
     public function profile($id)
    {
        $user = User::findOrFail($id);
        $posts = Post::where('user_id', $id)->get();
        $Profile = Profile::where('user_id', $id)->first();

        return view('profile', compact('user', 'posts', 'professionalProfile'));
    }

    public function settingsProfile($id)
    {
        $user = User::findOrFail($id);
        $Profile = Profile::where('user_id', $id)->first();

        return view('settings-profile', compact('user', 'professionalProfile'));
    }

    public function community()
    {
        $friendRequests = Friends::all();
        $users = User::all();

        return view('community', compact('users', 'friendRequests'));
    }

    public function notifications()
    {
        $friendRequests = Friends::where('friend_id', Auth::id())->get();

        return view('notifications', compact('friendRequests'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('banner')) {
            $data['banner'] = $request->banner->store('banners', 'public');
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request->image->store('users', 'public');
        }

        $user->update($data);

        return redirect()->route('home')->with('success', 'Profile updated successfully');
    }

    public function addAboutUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'about' => 'required|string',
        ]);

        $user->update($data);

        return redirect()->route('home')->with('success', 'About information updated successfully');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $users = User::where('name', 'like', "%{$query}%")->get();

        return view('search-results', compact('users'));
    }

    
    
       
        
    

    


}
