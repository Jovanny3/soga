<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


// app/Http/Controllers/MessageController.php
class MessageController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $conversations = Message::where('sender_id', $user->id)
            ->orWhere('recipient_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function ($message) use ($user) {
                return $message->sender_id === $user->id ? $message->recipient_id : $message->sender_id;
            });

        return view('messages.index', compact('conversations'));
    }

    public function show(User $user)
    {
        $authUser = Auth::user();
        $messages = Message::where(function ($query) use ($authUser, $user) {
            $query->where('sender_id', $authUser->id)->where('recipient_id', $user->id);
        })->orWhere(function ($query) use ($authUser, $user) {
            $query->where('sender_id', $user->id)->where('recipient_id', $authUser->id);
        })->orderBy('created_at')->get();

        return view('messages.show', compact('user', 'messages'));
    }

    public function sendMessage(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'content' => 'required|string',
        ]);

        $message = new Message();
        $message->sender_id = Auth::id();
        $message->recipient_id = $user->id;
        $message->content = $validatedData['content'];
        $message->save();

        return redirect()->back()->with('success', 'Message sent successfully.');
    }
}
