<?php

namespace App\Http\Controllers\Cms\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\RegisterEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class EventController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:event-list|event-create|event-update|event-delete', ['only' => ['index', 'addEventData']]);
        $this->middleware('permission:event-create', ['only' => ['addEvent', 'addEventData']]);
        $this->middleware('permission:event-update', ['only' => ['updateEvent', 'updateEventData']]);
        $this->middleware('permission:event-delete', ['only' => ['deleteEvent']]);
    }

    public function index()
    {
        $resultSet = Event::get();
        return view('cms.website.pages.event.index', compact('resultSet'));
    }

    public function addEvent()
    {
        return view('cms.website.pages.event.add');
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
            $purposePath = public_path() . '/assets/images/uploads/pages/event';
            $destination = public_path() . '/assets/images/uploads/pages/event/' . $newFileName;

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
        return redirect()->route('website.page.event')->with('success', 'Your data is successfully added!');
    }

    public function updateEvent($eventId)
    {
        $updateEvent = Event::where('id', $eventId)->first();
        return view('cms.website.pages.event.update', compact('updateEvent'));
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
            if (file_exists(public_path() . '/assets/images/uploads/pages/event/' . $updateEvent->image)) {
                unlink(public_path() . '/assets/images/uploads/pages/event/' . $updateEvent->image);
            }
            $img = Image::make(request()->file('image'));
            $extension = request()->file('image')->extension();
            $random = Str::random(30);
            $dt = Carbon::now()->timestamp;
            $newFileName = $random . '-' . $dt . '.' . $extension;
            $purposePath = public_path() . '/assets/images/uploads/pages/event';
            $destination = public_path() . '/assets/images/uploads/pages/event/' . $newFileName;

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

        return redirect()->route('website.page.event')->with('success', 'Your data is successfully updated!');
    }

    public function deleteEvent($eventId)
    {
        $msg = "Some thing went wrong!";
        $code = 400;
        $updateEvent = Event::where('id', $eventId)->first();
        if (!empty($updateEvent)) {
            $msgText = $updateEvent->is_disabled ? "enabled" : "disabled";
            $updateEvent->update(['is_disabled' => $updateEvent->is_disabled ? 0 : 1]);
            $msg = "Successfully {$msgText}!";
            $code = 200;
        }
        return response()->json(['msg' => $msg], $code);
    }
}
