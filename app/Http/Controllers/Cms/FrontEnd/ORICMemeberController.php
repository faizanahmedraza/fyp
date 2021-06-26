<?php

namespace App\Http\Controllers\Cms\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\CMSORICMember;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ORICMemeberController extends Controller
{
    public function index()
    {
        $resultSet = CMSORICMember::get();
        return view('cms.website.pages.home.oric-member.index',compact('resultSet'));
    }

    public function addMember()
    {
        return view('cms.website.pages.home.oric-member.add');
    }

    public function addMemberData(){
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
                CMSORICMember::create([
                    'profile_picture' => $newFileName,
                    'name' => request()->name,
                    'designation' => request()->designation,
                    'description' => request()->description,
                    'created_by' => Auth::id()
                ]);
            } else {
                return back()->with('error', 'File not Saved in Database!');
            }
            return redirect()->route('website.page.home.oric-member')->with('success', 'Your data is successfully added!');
        }
    }

    public function updateMember($cmsMemberId){
        $updateMember = CMSORICMember::findOrFail($cmsMemberId);
        return view('cms.website.pages.home.oric-member.update',compact('updateMember'));
    }

    public function updateMemberData($cmsMemberId){
        $updateMember = CMSORICMember::findOrFail($cmsMemberId);

        if(!empty(request()->file('profile_picture'))){
            unlink(givePath() . '/assets/images/uploads/pages/' . $updateMember->profile_picture);
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
                $updateMember->update([
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
            $updateMember->update([
                'profile_picture' => $updateMember->profile_picture,
                'name' => request()->name,
                'designation' => request()->designation,
                'description' => request()->description,
                'updated_by' => Auth::id()
            ]);
        }
        return redirect()->route('website.page.home.oric-member')->with('success', 'Your data is successfully updated!');
    }

    public function deleteMember($cmsMemberId){
        $msg = "Some thing went wrong!";
        $code = 400;
        $records = CMSORICMember::all();
        $updateMember = CMSORICMember::findOrFail($cmsMemberId)->first();
        if (count($records) > 3) {
            if (!empty($updateMember)) {
                unlink(givePath().'/assets/images/uploads/pages/'.$updateMember->profile_picture);
                $updateMember->delete();
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
