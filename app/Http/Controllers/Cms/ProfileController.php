<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = Auth::user();
        return view('cms.profile', compact('profile'));
    }

    public function updateProfile()
    {
        $profile = Auth::user();
        request()->validate([
            'first_name' => 'required|max:55',
            'last_name' => 'required|max:55',
            'father_name' => 'sometimes|nullable|max:55',
            'email' => 'required|email:rfc|max:255|unique:users,email,' . $profile->id,
            'cnic' => 'sometimes|nullable|digits_between:13,13',
            'contact' => 'sometimes|nullable|digits_between:11,13',
            'gender' => 'sometimes|nullable|in:male,female,other|max:10',
            'dob' => 'sometimes|nullable|date',
            'designation' => 'sometimes|nullable|max:55',
            'expertise' => 'sometimes|nullable|max:255',
            'qualification' => 'sometimes|nullable|',
            'profile_picture' => 'sometimes|nullable|image|mimes:jpeg,jpg,png|max:2048',
            'profile_detail' => 'sometimes|nullable|string|max:400',
        ]);

        if (\request()->hasFile('profile_picture')) {
            $img = Image::make(\request()->file('profile_picture'));
            $extension = \request()->file('profile_picture')->extension();
            $newFileName = Str::random(10) . Carbon::now()->timestamp . '.' . $extension;
            $purposePath = public_path() . '/assets/images/user_profile/';
            $destination = public_path() . '/assets/images/user_profile/' . $newFileName;

            if (File::isDirectory($purposePath)) {
                File::makeDirectory($purposePath, 0777, true, true);
            }

            $check = $img->save($destination, 70);

            if ($check) {
                $profile->update([
                    'profile_picture' => $newFileName
                ]);
            } else {
                File::delete($destination);
                return back()->withErrors(['error', 'File have not been saved in database!'])->withInput();
            }
        }

        $profile->update([
            'first_name' => request()->first_name,
            'last_name' => request()->last_name,
            'email' => request()->email,
            'cnic' => request()->cnic,
            'gender' => request()->gender,
            'dob' => request()->dob,
            'designation' => request()->designation,
            'qualification' => request()->qualification,
            'contact' => request()->contact,
            'profile_detail' => request()->profile_detail,
            'updated_by' => Auth::id()
        ]);

        return back()->with('success', 'Your profile has been successfully updated.');
    }
}
