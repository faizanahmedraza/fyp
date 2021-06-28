<?php

namespace App\Http\Controllers\Cms\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\CMSAboutUs;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $resultSet = CMSAboutUs::all();
        return view('admin.frontend.pages.about-us.index', compact('resultSet'));
    }

    public function addAboutUs()
    {
        return view('admin.frontend.pages.about-us.add');
    }

    public function addAboutUsData()
    {
        request()->validate([
            'title' => ['required'],
            'banner' => ['required', 'image', 'mimes:jpeg,jpg,png,svg', 'max:2048'],
            'vision' => ['required','max:150'],
            'mission' => ['required','max:500'],
            'description' => ['required']
        ]);

        if (request()->hasFile('banner')) {
            $img = Image::make(request()->file('banner'));
            $extension = request()->file('banner')->extension();
            $random = Str::random(30);
            $dt = Carbon::now()->timestamp;
            $newFileName = $random . '-' . $dt . '.' . $extension;
            $purposePath = givePath() . '/assets/frontend/uploads/pages';
            $destination = givePath() . '/assets/frontend/uploads/pages/' . $newFileName;

            if (File::isDirectory($purposePath)) {
                File::makeDirectory($purposePath, 0777, true, true);
            }

            $check = $img->save($destination);

            if ($check) {
                CMSAboutUs::create([
                    'title' => request()->title,
                    'banner' => $newFileName,
                    'vision' => request()->vision,
                    'mission' => request()->mission,
                    'description' => request()->description,
                    'created_by' => Auth::id()
                ]);
            } else {
                return back()->with('error', 'File not Saved in Database!');
            }
            return redirect()->route('frontend.page.about-us')->with('success', 'Your data is successfully added!');
        }
    }

    public function updateAboutUs($cmsAboutUsId)
    {
        $updateAboutUs = CMSAboutUs::findOrFail($cmsAboutUsId);
        return view('admin.frontend.pages.about-us.update', compact('updateAboutUs'));
    }

    public function updateAboutUsData($cmsAboutUsId)
    {

        $updateContact = CMSAboutUs::findOrFail($cmsAboutUsId);

        if (request()->banner) {
            request()->validate([
                'title' => ['required'],
                'banner' => ['required', 'image', 'mimes:jpeg,jpg,png,svg', 'max:2048'],
                'vision' => ['required','max:150'],
                'mission' => ['required','max:500'],
                'description' => ['required']
            ]);
            $img = Image::make(request()->file('banner'));
            $extension = request()->file('banner')->extension();
            $random = Str::random(30);
            $dt = Carbon::now()->timestamp;
            $newFileName = $random . '-' . $dt . '.' . $extension;
            $purposePath = givePath() . '/assets/frontend/uploads/pages';
            $destination = givePath() . '/assets/frontend/uploads/pages/' . $newFileName;

            if(File::isDirectory($purposePath)){
                File::makeDirectory($purposePath, 0777, true, true);
            }
            $check = $img->save($destination);

            if ($check) {
                $updateContact->update([
                    'title' => request()->title,
                    'banner' => $newFileName,
                    'vision' => request()->vision,
                    'mission' => request()->mission,
                    'description' => request()->description,
                    'updated_by' => Auth::id()
                ]);
            } else {
                return back()->withErrors(['error' => 'File not Saved in Database!'])->withInput();
            }
        } else {
            request()->validate([
                'title' => ['required'],
                'vision' => ['required','max:150'],
                'mission' => ['required','max:500'],
                'description' => ['required']
            ]);
            $updateContact->update([
                'title' => request()->title,
                'banner' => $updateContact->banner,
                'description' => request()->description,
                'updated_by' => Auth::id()
            ]);
        }
        return redirect()->route('frontend.page.about-us')->with('success', 'Your data is successfully updated!');
    }

    public function deleteContactUs($cmsAboutUsId)
    {
        $msg = "Some thing went wrong!";
        $code = 400;
        $records = CMSAboutUs::all();
        $updateContact = CMSAboutUs::findOrFail($cmsAboutUsId);
        if (count($records) > 1) {
            if (!empty($updateContact)) {
                unlink(givePath() .'/assets/frontend/uploads/pages/'. $updateContact->banner);
                $updateContact->delete();
                $msg = "Successfully Delete record!";
                $code = 200;
            }
        } else {
            $msg = "You have only 1 banner record Add more banners to remove them!";
            $code = 302;
        }
        return response()->json(['msg' => $msg], $code);
    }
}
