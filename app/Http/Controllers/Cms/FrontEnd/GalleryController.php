<?php

namespace App\Http\Controllers\Cms\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class GalleryController extends Controller
{
    public function index()
    {
        $resultSet = Gallery::with('getEvent')->get();
        return view('cms.website.pages.event.gallery.index', compact('resultSet'));
    }

    public function addGallery()
    {
        $events = Event::get();
        return view('cms.website.pages.event.gallery.add', compact('events'));
    }

    public function addGalleryData()
    {
        request()->validate([
            'event_name' => ['required', 'in:' . implode(',', Event::pluck('id')->toArray())],
            'image' => ['required', 'image', 'mimes:jpeg,jpg,png,svg', 'max:2048'],
        ]);

        if (request()->hasFile('image')) {
            $img = Image::make(request()->file('image'));
            $extension = request()->file('image')->extension();
            $random = Str::random(30);
            $dt = Carbon::now()->timestamp;
            $newFileName = $random . '-' . $dt . '.' . $extension;
            $purposePath = givePath() . '/assets/images/uploads/pages/event/gallery';
            $destination = givePath() . '/assets/images/uploads/pages/event/gallery/' . $newFileName;

            if (!File::isDirectory($purposePath)) {
                File::makeDirectory($purposePath, 0777, true, true);
            }
            $img->save($destination);
            Gallery::create([
                'event_id' => (int)request()->event_name,
                'image' => $newFileName,
                'created_by' => Auth::id()
            ]);
            return redirect()->route('website.page.event.gallery')->with('success', 'Your data is successfully added!');
        }
    }

    public function updateGallery($galleryId)
    {
        $updateGallery = Gallery::with('getEvent')->where('id', $galleryId)->first();
        $events = Event::get();
        return view('cms.website.pages.event.gallery.update', compact('updateGallery', 'events'));
    }

    public function updateGalleryData($galleryId)
    {
        $updateGallery = Gallery::with('getEvent')->where('id', $galleryId)->first();

        if (empty($updateGallery->image) && empty(request()->image)) {
            return back()->withErrors(['error' => 'The image is required'])->withInput();
        }

        request()->validate([
            'event_name' => ['required', 'in:' . implode(',', Event::pluck('id')->toArray())],
            'image' => ['sometimes', 'nullable', 'image', 'mimes:jpeg,jpg,png,svg', 'max:2048'],
        ]);

        if (!empty(request()->file('image'))) {
            unlink(givePath() . '/assets/images/uploads/pages/event/gallery/' . $updateGallery->image);
            $img = Image::make(request()->file('image'));
            $extension = request()->file('image')->extension();
            $random = Str::random(30);
            $dt = Carbon::now()->timestamp;
            $newFileName = $random . '-' . $dt . '.' . $extension;
            $purposePath = givePath() . '/assets/images/uploads/pages/event/gallery';
            $destination = givePath() . '/assets/images/uploads/pages/event/gallery/' . $newFileName;

            if (!File::isDirectory($purposePath)) {
                File::makeDirectory($purposePath, 0777, true, true);
            }
            $img->save($destination);
            $fileName = $newFileName;
        } else {
            $fileName = $updateGallery->image;
        }
        $updateGallery->update([
            'event_id' => (int)request()->event_name,
            'image' => $fileName,
            'updated_by' => Auth::id()
        ]);
        return redirect()->route('website.page.event.gallery')->with('success', 'Your data is successfully updated!');
    }

    public function deleteGallery($galleryId)
    {
        $msg = "Some thing went wrong!";
        $code = 400;
        $records = Gallery::all();
        $updateGallery = Gallery::where('id', $galleryId)->first();
        if (count($records) > 2) {
            if (!empty($updateGallery)) {
                $msgText = $updateGallery->is_disabled ? "enabled" : "disabled";
                $updateGallery->update(['is_disabled' => $updateGallery->is_disabled ? 0 : 1]);
                $msg = "Successfully {$msgText}!";
                $code = 200;
            }
        } else {
            $msg = "You have less than three records Add more record to remove them!";
            $code = 302;
        }
        return response()->json(['msg' => $msg], $code);
    }
}
