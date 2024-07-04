<?php
namespace App\Http\Controllers;

use App\Models\Friends;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Club;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PHPUnit\TextUI\XmlConfiguration\Group;

class UserController extends Controller
{
     public function index()
    {
        $newUsers = User::latest()->take(6)->get();
        $users = User::all();
        $posts = Post::with('user', 'comments')->get();
        $comments = Comment::all();
        $friendRequests = Friends::where('user_to', Auth::id())->get();;
        $communities = Club::all();

        return view('home', compact('posts', 'users', 'friendRequests', 'comments', 'communities', 'newUsers'));
    }

   /* public function profile($id)
    {
        $user = User::findOrFail($id);
        $posts = Post::where('user', $id)->get();
        $Profile = Profile::where('user_id', $id)->first();

        return view('profiles.profile', compact('user', 'posts', 'Profile'));
    } */


    public function profile($id)
{
    $user = User::findOrFail($id);
    $posts = Post::where('user', $id)->get();
    $profile = Profile::where('user_id', $id)->first();
    $friendRequests = Friends::all();

    return view('profiles.profile', compact('user', 'posts', 'profile', 'friendRequests'));
}

    public function settingsProfile($id)
    {
        $user = User::findOrFail($id);
        $Profile = Profile::where('user_id', $id)->first();

        return view('profiles.setting-profile', compact('user', 'Profile'));
    }

    public function community()
    {
        $friendRequests = Friends::all();
        $users = User::all();

        return view('clubs.community', compact('users', 'friendRequests'));
    }

    public function notifications()
    {
        /*
        $friendRequests = Friends::where('friend_id', Auth::id())->get();

        return view('notifications', compact('friendRequests'));*/

        $friendRequests = Friends::where('user_to', Auth::id())
                             ->where('status', 'pending')
                             ->get();

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
        $clubs = Club::where('name_community', 'like', "%{$query}%")
                 ->orWhere('description_community', 'like', "%{$query}%")
                 ->get();


        return view('search-results', compact('users', 'clubs'));
    }


    
}