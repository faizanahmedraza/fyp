<?php

namespace App\Http\Controllers\Cms\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\RegisterEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterEventController extends Controller
{
    public function index()
    {
        $events = Event::withCount(['getRegisteredEvents' => function($query) {
            $query->where('status','registered');
        }])->whereHas('getRegisteredEvents', function ($query) {
            $query->where('status','registered');
        })->get();
        return view('cms.website.pages.event.register-event.index',compact('events'));
    }

    public function detailEvent($registerEventId)
    {
        $registeredUsers = Event::with('getRegisteredEvents')->where('id',$registerEventId)->first();
        return view('cms.website.pages.event.register-event.detail',compact('registeredUsers'));
    }

    public function deleteEvent($registerEventId)
    {
        $msgTxt = "Something went wrong!";
        $code = 400;

        $event = RegisterEvent::findORFail($registerEventId);

        if(!empty($event))
        {
            $event->delete();
            $msgTxt = "Successfully Deleted.";
            $code = 200;
        }
        return response()->json(['msg' => $msgTxt],$code);
    }
}
