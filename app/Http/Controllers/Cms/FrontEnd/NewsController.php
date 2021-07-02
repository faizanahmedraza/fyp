<?php

namespace App\Http\Controllers\Cms\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\CMSNews;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class NewsController extends Controller
{
    public function index()
    {
        $resultSet = CMSNews::all();
        return view('cms.website.pages.news.index', compact('resultSet'));
    }

    public function addNews()
    {
        return view('cms.website.pages.news.add');
    }

    public function addNewsData()
    {
        request()->validate([
            'title' => ['required'],
            'banner' => ['required', 'image', 'mimes:jpeg,jpg,png,svg', 'max:2048'],
            'description' => ['required']
        ]);

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

            $check = $img->save($destination);

            if ($check) {
                CMSNews::create([
                    'title' => request()->title,
                    'banner' => $newFileName,
                    'description' => request()->description,
                    'created_by' => Auth::id()
                ]);
            } else {
                return back()->with('error', 'File not Saved in Database!');
            }
            return redirect()->route('website.page.news')->with('success', 'Your data is successfully added!');
        }
    }

    public function updateNews($newsId)
    {
        $updateNews = CMSNews::findOrFail($newsId);
        return view('cms.website.pages.news.update', compact('updateNews'));
    }

    public function updateNewsData($newsId)
    {

        $updateNews = CMSNews::findOrFail($newsId);

        if(empty($updateNews->banner) && empty(request()->banner))
        {
            return back()->withErrors(['error' => 'The banner image is required'])->withInput();
        }

        request()->validate([
            'title' => ['required'],
            'banner' => ['sometimes','nullable', 'image', 'mimes:jpeg,jpg,png,svg', 'max:2048'],
            'description' => ['required']
        ]);

        if (!empty(request()->banner)) {
            unlink(givePath() . '/assets/images/uploads/pages/' . $updateNews->banner);
            $img = Image::make(request()->file('banner'));
            $extension = request()->file('banner')->extension();
            $random = Str::random(30);
            $dt = Carbon::now()->timestamp;
            $newFileName = $random . '-' . $dt . '.' . $extension;
            $purposePath = givePath() . '/assets/images/uploads/pages';
            $destination = givePath() . '/assets/images/uploads/pages/' . $newFileName;

            if(File::isDirectory($purposePath)){
                File::makeDirectory($purposePath, 0777, true, true);
            }
            $check = $img->save($destination);

            if ($check) {
                $updateNews->update([
                    'title' => request()->title,
                    'banner' => $newFileName,
                    'description' => request()->description,
                    'updated_by' => Auth::id()
                ]);
            } else {
                return back()->withErrors(['error' => 'File not Saved in Database!'])->withInput();
            }
        } else {
            $updateNews->update([
                'title' => request()->title,
                'banner' => $updateNews->banner,
                'description' => request()->description,
                'updated_by' => Auth::id()
            ]);
        }
        return redirect()->route('website.page.news')->with('success', 'Your data is successfully updated!');
    }

    public function deleteNews($newsId)
    {
        $msg = "Some thing went wrong!";
        $code = 400;
        $records = CMSNews::all();
        $updateNews = CMSNews::findOrFail($newsId);
        if (count($records) > 1) {
            if (!empty($updateNews)) {
                unlink(givePath() .'/assets/images/uploads/pages/'. $updateNews->banner);
                $updateNews->delete();
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
