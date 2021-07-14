<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\RegisterEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:user-event-list',['only' => 'index']);
    }

    public function index()
    {
        $events = Event::with('getRegisteredEvents')->get();
        return view('frontend.event.index',compact('events'));
    }

    public function registerEvents()
    {
        $registerEvents = RegisterEvent::where('user_id',Auth::id())->get();
        return view('',compact('registerEvents'));
    }

    public function eventRegisterPerson($eventId)
    {
        RegisterEvent::create([
            'user_id' => Auth::id(),
            'event_id' => (int)$eventId
        ]);
        return response()->json(['msg' => 'You are successfully register for an event']);
    }
}
