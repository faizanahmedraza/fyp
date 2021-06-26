<?php

namespace App\Http\Controllers\Cms\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\CMSTestimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class TestimonialController extends Controller
{
    public function index()
    {
        $resultSet = CMSTestimonial::get();
        return view('cms.website.pages.home.testimonial.index',compact('resultSet'));
    }

    public function addTestimonial()
    {
        return view('cms.website.pages.home.testimonial.add');
    }

    public function addTestimonialData(){
        request()->validate([
            'profile_picture' => ['required','image','mimes:jpeg,jpg,png,svg','max:2048'],
            'name' => ['required'],
            'designation' => ['required','max:50'],
            'description' => ['required','max:200']
        ]);

        if (request()->hasFile('profile_picture')) {
            $img = Image::make(request()->file('profile_picture'));
            $extension = request()->file('profile_picture')->extension();
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
                CMSTestimonial::create([
                    'profile_picture' => $newFileName,
                    'name' => request()->name,
                    'designation' => request()->designation,
                    'description' => request()->description,
                    'created_by' => Auth::id()
                ]);
            } else {
                return back()->with('error', 'File not Saved in Database!');
            }
            return redirect()->route('website.page.home.testimonial')->with('success', 'Your data is successfully added!');
        }
    }

    public function updateTestimonial($cmsTestimonialId){
        $updateTestimonial = CMSTestimonial::findOrFail($cmsTestimonialId);
        return view('cms.website.pages.home.testimonial.update',compact('updateTestimonial'));
    }

    public function updateTestimonialData($cmsTestimonialId){
        $updateTestimonial = CMSTestimonial::findOrFail($cmsTestimonialId);

        if(!empty(request()->file('profile_picture'))){
            unlink(givePath() . '/assets/images/uploads/pages/' . $updateTestimonial->profile_picture);
            request()->validate([
                'profile_picture' => ['required','image','mimes:jpeg,jpg,png,svg','max:2048'],
                'name' => ['required'],
                'designation' => ['required','max:50'],
                'description' => ['required','max:200']
            ]);
            $img = Image::make(request()->file('profile_picture'));
            $extension = request()->file('profile_picture')->extension();
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
                $updateTestimonial->update([
                    'profile_picture' => $newFileName,
                    'name' => request()->name,
                    'designation' => request()->designation,
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
            $updateTestimonial->update([
                'profile_picture' => $updateTestimonial->profile_picture,
                'name' => request()->name,
                'designation' => request()->designation,
                'description' => request()->description,
                'updated_by' => Auth::id()
            ]);
        }
        return redirect()->route('website.page.home.testimonial')->with('success', 'Your data is successfully updated!');
    }

    public function deleteTestimonial($cmsTestimonialId){
        $msg = "Some thing went wrong!";
        $code = 400;
        $records = CMSTestimonial::all();
        $updateTestimonial = CMSTestimonial::findOrFail($cmsTestimonialId)->first();
        if (count($records) > 3) {
            if (!empty($updateTestimonial)) {
                unlink(givePath().'/assets/images/uploads/pages/'.$updateTestimonial->profile_picture);
                $updateTestimonial->delete();
                $msg = "Successfully Delete record!";
                $code = 200;
            }
        } else {
            $msg = "You have less than four records Add more record to remove them!";
            $code = 302;
        }
        return response()->json(['msg' => $msg],$code);
    }
}
