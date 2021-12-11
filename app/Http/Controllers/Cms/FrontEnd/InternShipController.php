<?php

namespace App\Http\Controllers\Cms\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\InternShip;
use App\Models\RegisterIntern;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class InternShipController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:internship-list|internship-create|internship-update|internship-delete', ['only' => ['index','addInternshipData']]);
        $this->middleware('permission:internship-create', ['only' => ['addInternship','addInternshipData']]);
        $this->middleware('permission:internship-update', ['only' => ['updateInternship','updateInternshipData']]);
        $this->middleware('permission:internship-delete', ['only' => ['deleteInternship']]);
    }

    public function index()
    {
        $resultSet = InternShip::get();
        return view('cms.website.pages.internship.index', compact('resultSet'));
    }

    public function addInternship()
    {
        return view('cms.website.pages.internship.add');
    }

    public function addInternshipData()
    {
        if (empty(request()->location) && request()->mode === 'Physical') {
            return back()->withErrors(['error' => 'The location field is required!']);
        }

        request()->validate([
            'image' => ['required', 'image', 'mimes:jpeg,jpg,png,svg', 'max:2048'],
            'title' => ['required', 'unique:internships,title,NULL,id,deleted_at,NULL', 'max:100'],
            'description' => ['required', 'max:800'],
            'mode' => ['required', 'in:Online,Physical'],
            'company' => ['required', 'max:100'],
            'location' => ['sometimes', 'nullable', 'max:200'],
            'paid' => ['sometimes','nullable', 'boolean'],
            'duration' => ['required', 'max:30'],
        ]);

        if (request()->hasFile('image')) {
            $img = Image::make(request()->file('image'));
            $extension = request()->file('image')->extension();
            $random = Str::random(30);
            $dt = Carbon::now()->timestamp;
            $newFileName = $random . '-' . $dt . '.' . $extension;
            $purposePath = public_path() . '/assets/images/uploads/pages/internship';
            $destination = public_path() . '/assets/images/uploads/pages/internship/' . $newFileName;

            if (!File::isDirectory($purposePath)) {
                File::makeDirectory($purposePath, 0777, true, true);
            }
            $img->save($destination);
            InternShip::create([
                'image' => $newFileName,
                'title' => request()->title,
                'slug' => Str::slug(request()->title),
                'description' => request()->description,
                'company' => request()->company,
                'mode' => request()->mode,
                'paid' => request()->paid ? : 0,
                'duration' => request()->duration
            ]);
        }
        return redirect()->route('website.page.internship')->with('success', 'Your data is successfully added!');
    }

    public function updateInternship($internshipId)
    {
        $updateInternship = InternShip::where('id', $internshipId)->first();
        return view('cms.website.pages.internship.update', compact('updateInternship'));
    }

    public function updateInternshipData($internshipId)
    {
        $updateInternship = InternShip::where('id', $internshipId)->first();

        if (empty($updateInternship->image) && empty(request()->image)) {
            return back()->withErrors(['error' => 'The image is required'])->withInput();
        }

        if (empty(request()->location) && request()->mode === 'Physical') {
            return back()->withErrors(['error' => 'The location field is required!']);
        }

        request()->validate([
            'image' => ['sometimes', 'nullable', 'image', 'mimes:jpeg,jpg,png,svg', 'max:2048'],
            'title' => ['required', 'unique:internships,title,' . $internshipId . ',id,deleted_at,NULL', 'max:100'],
            'description' => ['required', 'max:800'],
            'mode' => ['required', 'in:Online,Physical'],
            'company' => ['required', 'max:100'],
            'location' => ['sometimes', 'nullable', 'max:200'],
            'paid' => ['sometimes','nullable', 'boolean'],
            'duration' => ['required', 'max:30'],
        ]);

        if (!empty(request()->file('image'))) {
            if (file_exists(public_path() . '/assets/images/uploads/pages/internship/' . $updateInternship->image)) {
                unlink(public_path() . '/assets/images/uploads/pages/internship/' . $updateInternship->image);
            }
            $img = Image::make(request()->file('image'));
            $extension = request()->file('image')->extension();
            $random = Str::random(30);
            $dt = Carbon::now()->timestamp;
            $newFileName = $random . '-' . $dt . '.' . $extension;
            $purposePath = public_path() . '/assets/images/uploads/pages/internship';
            $destination = public_path() . '/assets/images/uploads/pages/internship/' . $newFileName;

            if (!File::isDirectory($purposePath)) {
                File::makeDirectory($purposePath, 0777, true, true);
            }
            $img->save($destination);
            $fileName = $newFileName;
        } else {
            $fileName = $updateInternship->image;
        }

        $updateInternship->update([
            'image' => $fileName,
            'title' => request()->title,
            'slug' => Str::slug(request()->title),
            'description' => request()->description,
            'company' => request()->company,
            'mode' => request()->mode,
            'paid' => request()->paid ? : 0,
            'duration' => request()->duration
        ]);

        return redirect()->route('website.page.internship')->with('success', 'Your data is successfully updated!');
    }

    public function deleteInternship($internshipId)
    {
        $msg = "Some thing went wrong!";
        $code = 400;
        $updateInternship = InternShip::where('id', $internshipId)->first();

        if (!empty($updateInternship)) {
            $msgText = $updateInternship->is_disabled ? "enabled" : "disabled";
            $updateInternship->update(['is_disabled' => $updateInternship->is_disabled ? 0 : 1]);
            $msg = "Successfully {$msgText}!";
            $code = 200;
        }

        return response()->json(['msg' => $msg], $code);
    }
}
