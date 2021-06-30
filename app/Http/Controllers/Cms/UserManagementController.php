<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Jobs\SendAccountVerificationEmailJob;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-update|user-delete', ['only' => ['index','addUserData']]);
        $this->middleware('permission:user-create', ['only' => ['addUser','addUserData']]);
        $this->middleware('permission:user-update', ['only' => ['updateUser','updateUserData']]);
        $this->middleware('permission:user-delete', ['only' => ['deleteUser']]);
    }

    public function index()
    {
        $users = User::with('roles')->get();
        $admin = User::role('super-admin')->first();
        return view('cms.user-management.index', compact('users','admin'));
    }

    public function addUser()
    {
        $roles = Role::where('name','!=','super-admin')->get();
        return view('cms.user-management.add',compact('roles'));
    }

    public function addUserData()
    {
        request()->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|max:255|unique:users,email,NULL,id,first_name,'.request('first_name').',last_name,'.request('last_name'),
            'cnic' => 'sometimes|nullable|digits_between:1,13',
            'contact'  => 'sometimes|nullable|digits_between:1,13',
            'role' => 'required|in:'.implode(',',Role::pluck('name')->toArray())
        ]);

        $user = User::create([
            'first_name' => request()->first_name,
            'last_name' => request()->last_name,
            'email' => request()->email,
            'password' => Str::random('30'),
            'cnic' => request()->cnic,
            'contact'  => request()->contact,
            'verification_token' => Str::random('50'),
            'created_by' => Auth::id()
        ]);

        $user->assignRole(request()->role);

        dispatch(new SendAccountVerificationEmailJob($user));

        return redirect('/admin/manage-users')->with('success','User successfully added.');
    }

    public function updateUser($userId)
    {
        $user = User::findOrFail($userId);
        $roles = Role::all();
        $userRoles = $user->roles->pluck('name')->all();
        $userRole = implode(',',$userRoles);
        return view('cms.user-management.update',compact('user','roles','userRole'));
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
            'role' => 'required|in:'.implode(',',Role::pluck('name')->toArray())
        ]);

        $user->update([
            'first_name' => request()->first_name,
            'last_name' => request()->last_name,
            'email' => request()->email,
            'cnic' => request()->cnic,
            'contact'  => request()->contact,
            'updated_by' => Auth::id()
        ]);

        $user->syncRoles(request()->role);

        return redirect('/admin/manage-users')->with('success','User successfully updated.');
    }

    public function getUserDetail($userId)
    {
        $user = User::findOrFail($userId);
        $userRoles = $user->roles->pluck('name')->all();
        $userRole = implode(',',$userRoles);
        return view('cms.user-management.detail', compact('user','userRole'));
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
