<?php

namespace App\Http\Controllers;


// app/Http/Controllers/FriendController.php
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Friends;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



// app/Http/Controllers/FriendController.php
class FriendController extends Controller
{
  public function addFriend(Request $request)
    {
        $data = $request->validate([
            'user_from' => 'required|exists:users,id',
            'user_to' => 'required|exists:users,id|different:user_from',
        ]);

        $data['status'] = 'pending';

        $friendRequest = Friends::create($data);

        return redirect()->route('community')->with('success', 'Friend request sent');
    }

  /*  public function requestFriend(Request $request, $id)
    {
        $friendRequest = Friends::findOrFail($id);
        
        $friendRequest->update($request->validate([
            'status' => 'required|in:accepted,rejected',
        ]));

        return redirect()->route('notifications')->with('success', 'Friend request updated');
    }*/

    public function requestFriend(Request $request, )
{
    $friendRequest = Friends::findOrFail($request->input('id'));
    
    $status = $request->input('status');
    
    if ($status === 'accepted') {
        $friendRequest->status = 'approved';
        $friendRequest->save();
        
        // Cria a relação inversa
        Friends::firstOrCreate([
            'user_from' => $friendRequest->user_to,
            'user_to' => $friendRequest->user_from,
            'status' => 'approved'
        ]);
        
        return redirect()->route('notifications')->with('success', 'Friend request accepted');
    } elseif ($status === 'rejected') {
        $friendRequest->delete();
        return redirect()->route('notifications')->with('success', 'Friend request rejected');
    }

    return redirect()->route('notifications')->with('error', 'Invalid action');
}



    // app/Http/Controllers/FriendController.php (continuação)
    public function removeFriend(User $user)
    {
        $authUser = User::user();
        $authUser->friends()->detach($user->id);
        $user->friends()->detach($authUser->id);
        return redirect()->back()->with('success', 'Friend removed successfully.');
    }
    
}