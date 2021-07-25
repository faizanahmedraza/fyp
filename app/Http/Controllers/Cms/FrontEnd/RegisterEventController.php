<?php

namespace App\Http\Controllers\Cms\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\RegisterEvent;
use Illuminate\Http\Request;

class RegisterEventController extends Controller
{
    public function index()
    {
        $events = RegisterEvent::withCount('getUser')->where('status','registered')->get();
        return view('cms.website.pages.event.register-event.index',compact('events'));
    }

    public function detailEvent($registerEventId)
    {
        $registeredUsers = RegisterEvent::with(['getUser','getEvent'])->where('id',$registerEventId)->get();
        return view('cms.website.pages.event.register-event.detail',compact('registeredUsers'));
    }

    public function deleteEvent($registerEventId)
    {
        //
    }
}
