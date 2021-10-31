<?php

namespace App\Http\Controllers\Cms\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\CMSResearch;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ResearchController extends Controller
{
    public function index()
    {
        $resultSet = CMSResearch::all();
        return view('cms.website.pages.research.index', compact('resultSet'));
    }

    public function addResearch()
    {
        return view('cms.website.pages.research.add');
    }

    public function addResearchData()
    {
        request()->validate([
            'title' => ['required'],
            'banner' => ['required', 'image', 'mimes:jpeg,jpg,png,svg', 'max:2048'],
            'description' => ['required']
        ]);
        $newFileName = '';
        if (request()->hasFile('banner')) {
            $img = Image::make(request()->file('banner'));
            $extension = request()->file('banner')->extension();
            $random = Str::random(30);
            $dt = Carbon::now()->timestamp;
            $newFileName = $random . '-' . $dt . '.' . $extension;
            $purposePath = givePath() . '/assets/images/uploads/pages';
            $destination = givePath() . '/assets/images/uploads/pages/' . $newFileName;

            if (File::isDirectory($purposePath)) {
                File::makeDirectory($purposePath, 0777, true, true);
            }

            $img->save($destination);
        }
        CMSResearch::create([
            'title' => request()->title,
            'banner' => $newFileName,
            'description' => request()->description,
            'created_by' => Auth::id()
        ]);
        return redirect()->route('website.page.research')->with('success', 'Your data is successfully added!');
    }

    public function updateResearch($researchId)
    {
        $updateResearch = CMSResearch::findOrFail($researchId);
        return view('cms.website.pages.research.update', compact('updateResearch'));
    }

    public function updateResearchData($researchId)
    {

        $updateResearch = CMSResearch::findOrFail($researchId);

        if (empty($updateResearch->banner) && empty(request()->banner)) {
            return back()->withErrors(['error' => 'The banner image is required'])->withInput();
        }

        request()->validate([
            'title' => ['required'],
            'banner' => ['sometimes', 'nullable', 'image', 'mimes:jpeg,jpg,png,svg', 'max:2048'],
            'description' => ['required']
        ]);

        if (!empty(request()->banner)) {
            unlink(givePath() . '/assets/images/uploads/pages/' . $updateResearch->banner);
            $img = Image::make(request()->file('banner'));
            $extension = request()->file('banner')->extension();
            $random = Str::random(30);
            $dt = Carbon::now()->timestamp;
            $newFileName = $random . '-' . $dt . '.' . $extension;
            $purposePath = givePath() . '/assets/images/uploads/pages';
            $destination = givePath() . '/assets/images/uploads/pages/' . $newFileName;

            if (File::isDirectory($purposePath)) {
                File::makeDirectory($purposePath, 0777, true, true);
            }
            $img->save($destination);
          $filename = $newFileName;
        } else {
            $filename = $updateResearch->banner;
        }
        $updateResearch->update([
            'title' => request()->title,
            'banner' => $filename,
            'description' => request()->description,
            'updated_by' => Auth::id()
        ]);
        return redirect()->route('website.page.research')->with('success', 'Your data is successfully updated!');
    }

    public function deleteResearch($researchId)
    {
        $msg = "Some thing went wrong!";
        $code = 400;
        $records = CMSResearch::all();
        $updateResearch = CMSResearch::findOrFail($researchId);
        if (count($records) > 1) {
            if (!empty($updateResearch)) {
                $msgText = $updateResearch->is_disabled ? "enabled" : "disabled";
                $updateResearch->update(['is_disabled' => $updateResearch->is_disabled ? 0 : 1]);
                $msg = "Successfully {$msgText}!";
                $code = 200;
            }
        } else {
            $msg = "You have only 1 record Add more records to remove them!";
            $code = 302;
        }
        return response()->json(['msg' => $msg], $code);
    }
}
