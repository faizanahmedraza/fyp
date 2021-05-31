<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Jobs\SendAccountVerificationEmailJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('cms.user-management.index', compact('users'));
    }

    public function addUser()
    {
        return view('cms.user-management.add');
    }

    public function addUserData()
    {
        request()->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|max:255|unique:users,email,NULL,id,first_name,'.request('first_name').',last_name,'.request('last_name'),
            'cnic' => 'sometimes|nullable|digits_between:1,13',
            'contact'  => 'sometimes|nullable|digits_between:1,13',
        ]);

        $user = User::create([
            'first_name' => request()->first_name,
            'last_name' => request()->last_name,
            'email' => request()->email,
            'password' => Str::random('30'),
            'cnic' => request()->cnic,
            'contact'  => request()->contact,
            'created_by' => Auth::id()
        ]);

        dispatch(new SendAccountVerificationEmailJob($user));

        return redirect('/admin/manage-users')->with('success','User successfully added.');
    }

    public function updateUser($userId)
    {
        $user = User::findOrFail($userId);
        return view('cms.user-management.update',compact('user'));
    }

    public function updateUserData($userId)
    {
        $user = User::findOrFail($userId);
        request()->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|max:255|unique:users,email,'.$userId.',id,first_name,'.request('first_name').',last_name,'.request('last_name'),
            'cnic' => 'sometimes|nullable|digits_between:1,13',
            'contact'  => 'sometimes|nullable|digits_between:1,13',
        ]);

        $user->update([
            'first_name' => request()->first_name,
            'last_name' => request()->last_name,
            'email' => request()->email,
            'cnic' => request()->cnic,
            'contact'  => request()->contact,
            'updated_by' => Auth::id()
        ]);

        return redirect('/admin/manage-users')->with('success','User successfully updated.');
    }

    public function getUserDetail($userId)
    {
        $user = User::findOrFail($userId);
        return view('cms.user-management.detail', compact('user'));
    }

    public function blockUser($userId){
        $msg = 'Something went wrong.';
        $code = 400;
        $user = User::findOrFail($userId);

        if (!empty($user)) {
            $msgText = $user->is_block ? "unblock" : "blocked";
            $user->update(['is_block' => $user->is_block ? 0 : 1]);
            $msg = "User successfully {$msgText}!";
            $code = 200;
        }

        return response()->json(['msg' => $msg], $code);
    }
}
