<?php

namespace App\Http\Controllers\Cms\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class EventController extends Controller
{
    public function index()
    {
        $resultSet = Event::get();
        return view('cms.website.pages.event.index',compact('resultSet'));
    }

    public function addEvent()
    {
        return view('cms.website.pages.event.add');
    }

    public function addEventData(){
        request()->validate([
            'image' => ['required','image','mimes:jpeg,jpg,png,svg','max:2048'],
            'title' => ['required','unique:event,title,NULL,id,deleted_at,NULL','max:100'],
            'description' => ['required','max:200']
        ]);

        if (request()->hasFile('image')) {
            $img = Image::make(request()->file('image'));
            $extension = request()->file('image')->extension();
            $random = Str::random(30);
            $dt = Carbon::now()->timestamp;
            $newFileName = $random.'-'.$dt.'.'.$extension;
            $purposePath = givePath().'/assets/images/uploads/pages/event';
            $destination = givePath().'/assets/images/uploads/pages/event/'.$newFileName;

            if(!File::isDirectory($purposePath)){
                File::makeDirectory($purposePath, 0777, true, true);
            }

            $check = $img->save($destination);
            if ($check) {
                Event::create([
                    'image' => $newFileName,
                    'title' => request()->title,
                    'slug' => Str::slug(request()->title),
                    'description' => request()->description,
                    'is_active' => 0,
                    'created_by' => Auth::id()
                ]);
            } else {
                return back()->with('error', 'File not Saved in Database!');
            }
            return redirect()->route('website.page.event')->with('success', 'Your data is successfully added!');
        }
    }

    public function updateEvent($eventId){
        $updateEvent = Event::where('id',$eventId)->first();
        return view('cms.website.pages.event.update',compact('updateEvent'));
    }

    public function updateEventData($eventId){
        $updateEvent = Event::where('id',$eventId)->first();

        if(empty($updateEvent->image) && empty(request()->image))
        {
            return back()->withErrors(['error' => 'The image is required'])->withInput();
        }

        request()->validate([
            'image' => ['sometimes','nullable','image','mimes:jpeg,jpg,png,svg','max:2048'],
            'title' => ['required','unique:event,title,'.$eventId.',id,deleted_at,NULL','max:100'],
            'description' => ['required','max:200']
        ]);

        if(!empty(request()->file('image'))){
            unlink(givePath() . '/assets/images/uploads/pages/event/' . $updateEvent->image);
            $img = Image::make(request()->file('image'));
            $extension = request()->file('image')->extension();
            $random = Str::random(30);
            $dt = Carbon::now()->timestamp;
            $newFileName = $random.'-'.$dt.'.'.$extension;
            $purposePath = givePath().'/assets/images/uploads/pages/event';
            $destination = givePath().'/assets/images/uploads/pages/event/'.$newFileName;

            if(!File::isDirectory($purposePath)){
                File::makeDirectory($purposePath, 0777, true, true);
            }
            $check = $img->save($destination);

            if ($check) {
                $updateEvent->update([
                    'image' => $newFileName,
                    'title' => request()->title,
                    'slug' => Str::slug(request()->title),
                    'description' => request()->description,
                    'updated_by' => Auth::id()
                ]);
            } else {
                return back()->withErrors(['error' => 'File not Saved in Database!'])->withInput();
            }

        } else {
            $updateEvent->update([
                'image' => $updateEvent->image,
                'title' => request()->title,
                'slug' => Str::slug(request()->title),
                'description' => request()->description,
                'updated_by' => Auth::id()
            ]);
        }
        return redirect()->route('website.page.event')->with('success', 'Your data is successfully updated!');
    }

    public function deleteEvent($eventId){
        $msg = "Some thing went wrong!";
        $code = 400;
        $records = Event::all();
        $updateEvent = Event::where('id',$eventId)->first();
        if (count($records) > 2) {
            if (!empty($updateEvent)) {
                unlink(givePath().'/assets/images/uploads/pages/event/'.$updateEvent->image);
                $updateEvent->delete();
                $msg = "Successfully Delete record!";
                $code = 200;
            }
        } else {
            $msg = "You have less than three records Add more record to remove them!";
            $code = 302;
        }
        return response()->json(['msg' => $msg],$code);
    }
}
