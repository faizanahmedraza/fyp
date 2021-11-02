<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\RegisterEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Spatie\Permission\Models\Role;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:user-event-list|user-event-create|user-event-update', ['only' => 'index','addEventData']);
        $this->middleware('permission:user-event-create', ['only' => ['addEvent', 'addEventData']]);
        $this->middleware('permission:user-event-update', ['only' => ['updateEvent', 'updateEventData']]);
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
            'visitor_ip' => request()->ip()
        ],[ 'guest_name' => request()->guestName,'status' => 'registered']);
        return response()->json(['msg' => "You successfully registered \n Thanks For Registering an Event!"], 200);
    }

    public function addEvent()
    {
        return view('frontend.event.add');
    }

    public function addEventData()
    {
        if (empty(request()->location) && request()->mode === 'Physical') {
            return back()->withErrors(['error' => 'The location field is required!']);
        }

        request()->validate([
            'image' => ['required', 'image', 'mimes:jpeg,jpg,png,svg', 'max:2048'],
            'title' => ['required', 'unique:event,title,NULL,id,deleted_at,NULL', 'max:100'],
            'description' => ['required', 'max:500'],
            'mode' => ['required', 'in:Online,Physical'],
            'schedule' => ['required', 'date_format:d-m-Y H:i:s'],
            'location' => ['sometimes', 'nullable', 'max:55']
        ]);

        if (request()->hasFile('image')) {
            $img = Image::make(request()->file('image'));
            $extension = request()->file('image')->extension();
            $random = Str::random(30);
            $dt = Carbon::now()->timestamp;
            $newFileName = $random . '-' . $dt . '.' . $extension;
            $purposePath = givePath() . '/assets/images/uploads/pages/event';
            $destination = givePath() . '/assets/images/uploads/pages/event/' . $newFileName;

            if (!File::isDirectory($purposePath)) {
                File::makeDirectory($purposePath, 0777, true, true);
            }

            $img->save($destination);
            Event::create([
                'image' => $newFileName,
                'title' => request()->title,
                'slug' => Str::slug(request()->title),
                'description' => request()->description,
                'mode' => request()->mode,
                'schedule' => \Carbon\Carbon::parse(request()->schedule)->format('Y-m-d H:i:s'),
                'location' => request()->location,
                'created_by' => Auth::id()
            ]);
        }
        return redirect('/user/events')->with('success','Successfully added.');
    }

    public function updateEvent($eventId)
    {
        $updateEvent = Event::where('id', $eventId)->first();
        return view('frontend.event.update', compact('updateEvent'));
    }

    public function updateEventData($eventId)
    {
        $updateEvent = Event::where('id', $eventId)->first();

        if (empty($updateEvent->image) && empty(request()->image)) {
            return back()->withErrors(['error' => 'The image is required'])->withInput();
        }

        if (empty(request()->location) && request()->mode === 'Physical') {
            return back()->withErrors(['error' => 'The location field is required!']);
        }

        request()->validate([
            'image' => ['sometimes', 'nullable', 'image', 'mimes:jpeg,jpg,png,svg', 'max:2048'],
            'title' => ['required', 'unique:event,title,' . $eventId . ',id,deleted_at,NULL', 'max:100'],
            'description' => ['required', 'max:500'],
            'mode' => ['required', 'in:Online,Physical'],
            'schedule' => ['required', 'date_format:d-m-Y H:i:s'],
            'location' => ['sometimes', 'nullable', 'max:55']
        ]);

        if (!empty(request()->file('image'))) {
            if (file_exists(givePath() . '/assets/images/uploads/pages/event/' . $updateEvent->image)) {
                unlink(givePath() . '/assets/images/uploads/pages/event/' . $updateEvent->image);
            }
            $img = Image::make(request()->file('image'));
            $extension = request()->file('image')->extension();
            $random = Str::random(30);
            $dt = Carbon::now()->timestamp;
            $newFileName = $random . '-' . $dt . '.' . $extension;
            $purposePath = givePath() . '/assets/images/uploads/pages/event';
            $destination = givePath() . '/assets/images/uploads/pages/event/' . $newFileName;

            if (!File::isDirectory($purposePath)) {
                File::makeDirectory($purposePath, 0777, true, true);
            }
            $img->save($destination);
            $fileName = $newFileName;
        } else {
            $fileName = $updateEvent->image;
        }

        $updateEvent->update([
            'image' => $fileName,
            'title' => request()->title,
            'slug' => Str::slug(request()->title),
            'description' => request()->description,
            'mode' => request()->mode,
            'schedule' => \Carbon\Carbon::parse(request()->schedule)->format('Y-m-d H:i:s'),
            'location' => request()->location,
            'updated_by' => Auth::id()
        ]);

        return redirect('/user/events')->with('success', 'Successfully updated!');
    }
}
