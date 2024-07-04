<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Event;
    // app/Http/Controllers/EventController.php
class EventController extends Controller
{
    public function index()
    {
        $events = Event::paginate(20);
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
        ]);

        $event = Event::create($validatedData);
        $event->users()->attach(Auth::id());

        return redirect()->route('events.show', $event)->with('success', 'Event created successfully.');
    }

    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

}
