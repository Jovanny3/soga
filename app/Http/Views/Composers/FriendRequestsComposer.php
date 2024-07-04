<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Friends;

class FriendRequestsComposer
{
    public function compose(View $view)
    {
        $view->with('friendRequests', Friends::all());
    }
}