<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class SuccessStoryController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('website.pages.success-story',compact('events'));
    }
}
