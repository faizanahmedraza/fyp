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
        $this->middleware('permission:user-event-list', ['only' => 'index']);
    }

    public function index()
    {
        $events = Event::with(['getRegisteredEvents'=>function ($query){
            $query->where('deleted_at',null);
        }])->get();
        return view('frontend.event.index', compact('events'));
    }

    public function authUserEventRegister($eventId)
    {
        $user = RegisterEvent::where('event_id', $eventId)->where('user_id', Auth::id())->first();

        if (!empty($user)) {
            $user->delete();
            return response()->json(['msg' => "You successfully un registered!"], $code = 200);
        } else {
            RegisterEvent::updateOrCreate([
                'user_id' => Auth::id(),
                'event_id' => (int)$eventId,
            ]);
            return response()->json(['msg' => "You successfully registered!"],$code = 200);
        }
    }
}
