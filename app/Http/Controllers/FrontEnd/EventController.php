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
        $events = Event::with(['getRegisteredEvents' => function ($query) {
            $query->where('status', 'registered')->where('deleted_at', null);
        }])->get();
        return view('frontend.event.index', compact('events'));
    }

    public function authUserEventRegister($eventId = '')
    {
        $user = RegisterEvent::where('event_id', $eventId)->where('user_id', Auth::id())->first();
        $msgTxt = "registered";
        if (!empty($user)) {
            if ($user->status === "un-registered") {
                $status = "registered";
            } else {
                $status = "un-registered";
            }
            $user->update(['status' => $status]);
            $msgTxt = str_replace('-', '', $status);
        } else {
            $data['event_id'] = (int)request()->eventId;
            $data['user_id'] = Auth::id();
            $data['status'] = "registered";
            RegisterEvent::create($data);
        }
        return response()->json(['msg' => "You successfully {$msgTxt}!"], 200);
    }

    public function guestUserEventRegister()
    {
        RegisterEvent::updateOrCreate([
            'event_id' => request()->eventId,
            'guest_email' => request()->guestEmail,
        ],[ 'guest_name' => request()->guestName,'status' => 'registered']);
        return response()->json(['msg' => "You successfully registered \n Thanks For Registering an Event!"], 200);
    }
}
