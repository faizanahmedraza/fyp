<?php

namespace App\Http\Controllers\Cms\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\CMSHome;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    public function index()
    {
        $resultSet = CMSHome::get();
        return view('cms.website.pages.home.index',compact('resultSet'));
    }

    public function addHome()
    {
        return view('cms.website.pages.home.add');
    }

    public function addHomeData(){
        request()->validate([
            'banner' => ['required','image','mimes:jpeg,jpg,png,svg','max:2048'],
            'description' => ['required','max:150']
        ]);

        if (request()->hasFile('banner')) {
            $img = Image::make(request()->file('banner'));
            $extension = request()->file('banner')->extension();
            $random = Str::random(30);
            $dt = Carbon::now()->timestamp;
            $newFileName = $random.'-'.$dt.'.'.$extension;
            $purposePath = givePath().'/assets/images/uploads/pages';
            $destination = givePath().'/assets/images/uploads/pages/'.$newFileName;

            if(!File::isDirectory($purposePath)){
                File::makeDirectory($purposePath, 0777, true, true);
            }

            $check = $img->save($destination);
            if ($check) {
                CMSHome::create([
                    'banner' => $newFileName,
                    'description' => request()->description,
                    'created_by' => Auth::id()
                ]);
            } else {
                return back()->with('error', 'File not Saved in Database!');
            }
            return redirect()->route('website.page.home')->with('success', 'Your data is successfully added!');
        }
    }

    public function updateHome($cmsHomeId){
        $updateHome = CMSHome::findOrFail($cmsHomeId);
        return view('cms.website.pages.home.update',compact('updateHome'));
    }

    public function updateHomeData($cmsHomeId){
        $updateHome = CMSHome::findOrFail($cmsHomeId);

        if(!empty(request()->file('banner'))){
            request()->validate([
                'banner' => ['required','image','mimes:jpeg,jpg,png,svg','max:2048'],
                'description' => ['required']
            ]);
//            unlink(givePath() . '/assets/images/uploads/pages/' . $updateHome->banner);
            $img = Image::make(request()->file('banner'));
            $extension = request()->file('banner')->extension();
            $random = Str::random(30);
            $dt = Carbon::now()->timestamp;
            $newFileName = $random.'-'.$dt.'.'.$extension;
            $purposePath = givePath().'/assets/images/uploads/pages';
            $destination = givePath().'/assets/images/uploads/pages/'.$newFileName;

            if(!File::isDirectory($purposePath)){
                File::makeDirectory($purposePath, 0777, true, true);
            }
            $check = $img->save($destination);

            if ($check) {
                $updateHome->update([
                    'banner' => $newFileName,
                    'description' => request()->description,
                    'updated_by' => Auth::id()
                ]);
            } else {
                return back()->withErrors(['error' => 'File not Saved in Database!'])->withInput();
            }

        } else {
            request()->validate([
                'description' => ['required']
            ]);
            $updateHome->update([
                'banner' => $updateHome->banner,
                'description' => request()->description,
                'updated_by' => Auth::id()
            ]);
        }
        return redirect()->route('website.page.home')->with('success', 'Your data is successfully updated!');
    }

    public function deleteHome($cmsHomeId){
        $msg = "Some thing went wrong!";
        $code = 400;
        $records = CMSHome::all();
        $updateHome = CMSHome::where('id',$cmsHomeId)->first();
        if (count($records) > 2) {
            if (!empty($updateHome)) {
                $msgText = $updateHome->is_disabled ? "enabled" : "disabled";
                $updateHome->update(['is_disabled' => $updateHome->is_disabled ? 0 : 1]);
                $msg = "Successfully {$msgText}!";
                $code = 200;
            }
        } else {
            $msg = "You have only 3 banners record Add more banners to remove them!";
            $code = 302;
        }
        return response()->json(['msg' => $msg],$code);
    }
}
