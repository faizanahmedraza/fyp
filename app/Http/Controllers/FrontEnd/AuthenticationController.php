<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Jobs\NewStudentEmailJob;
use App\Jobs\SendForgotPasswordEmailJob;
use App\Jobs\SendStudentForgotPasswordEmailJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class AuthenticationController extends Controller
{
    public function index()
    {
        return view('frontend.authentication.login');
    }

    public function loginData()
    {
        $validator = Validator::make(request()->all(), [
            'email' => 'required|email:rfc|max:255',
            'password' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        if (!empty(Auth::validate(['email' => request()->email, 'password' => request()->password]))) {

            $rememberMe = !empty(request()->remember_me) ?: false;
            $user = User::where('email', request()->email)->first();

            if (!empty($user->is_block)) {
                return redirect()->back()->with('error', 'You are temporary blocked. Kindly contact to your administrator.');
            }

            if (empty($user->is_verified)) {
                return redirect()->back()->with('error', 'Please verify your account first.');
            }

            if (Auth::attempt(['email' => request()->email, 'password' => request()->password], $rememberMe)) {
                if (!in_array(Arr::first($user->getRoleNames()), ['student', 'researcher', 'faculty', 'focal-person','oric-member'])) {
                    return redirect('/admin/dashboard');
                } else {
                    return redirect('/user/dashboard');
                }
            }
        }
        return back()->with('error', 'Incorrect email or password.')->withInput(request()->except('password'));
    }

    public function registerUser()
    {
        $roles = Role::whereIn('name', ['researcher', 'student'])->get();
        return view('frontend.authentication.register', compact('roles'));
    }

    public function registerUserData()
    {
        request()->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email:rfc|max:255|unique:users,email,NULL,id,first_name,' . request('first_name') . ',last_name,' . request('last_name'),
            'password' => 'required|string|max:255|min:8|confirmed',
            'password_confirmation' => 'required|string|max:255|min:8|max:255',
            'user_type' => 'required|in:' . implode(',', Role::whereIn('name', ['researcher', 'student'])->pluck('id')->toArray()),
        ]);

        $user = User::create([
            'first_name' => request()->first_name,
            'last_name' => request()->last_name,
            'email' => request()->email,
            'password' => request()->password,
            'verification_token' => Str::random('50'),
            'created_by' => null
        ]);

        $user->assignRole(request()->user_type);

        dispatch(new NewStudentEmailJob($user));

        return redirect('/login')->with('success', 'Successfully account created. Verification link has send to your email address.');
    }

    public function userVerification($verificationToken)
    {
        $user = User::where('verification_token', $verificationToken)->first();
        if (!empty($user)) {
            $user->update([
                'verification_token' => null,
                'is_verified' => 1,
            ]);
        }
        return redirect('/login')->with('success', 'Your account is verified. Please Login.');
    }

    public function userPasswordVerification($verificationToken)
    {
        $user = User::where('verification_token', $verificationToken)->first();
        if (!empty($user)) {
            return view('frontend.authentication.user_verify', compact('verificationToken'));
        } else {
            if (!empty($user) && !in_array(Arr::first($user->getRoleNames()), ['student', 'researcher', 'faculty', 'focal-person','oric-member'])) {
                return redirect('/admin/login');
            } else {
                return redirect('/login');
            }
        }
    }

    public function userPasswordVerificationData($verificationToken)
    {

        $validator = Validator::make(request()->all(), [
            'password' => 'required|min:6|max:255|confirmed',
            'password_confirmation' => 'required|min:6|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::where('verification_token', $verificationToken)->first();

        if (!empty($user)) {

            $user->update([
                'verification_token' => null,
                'is_verified' => 1,
                'password' => Hash::make(request()->password)
            ]);

            Auth::loginUsingId($user->id);

            if (!in_array(Arr::first($user->getRoleNames()), ['student', 'researcher', 'faculty', 'focal-person','oric-member'])) {
                return redirect('/admin/dashboard');
            } else {
                return redirect('/user/dashboard');
            }
        }
        abort(404);
    }

    public function forgotPassword()
    {
        return view('frontend.authentication.forgot_password');
    }

    public function forgotPasswordData()
    {

        $user = User::where('email', request()->email)->first();

        if (!empty($user)) {

            if (!empty($user->is_block)) {
                return redirect()->back()->with('error', 'You are temporary blocked. Kindly contact to your administrator.');
            }

            if (empty($user->is_verified)) {
                return redirect()->back()->with('error', 'Please verify your account first.');
            }

            $user->update([
                'verification_token' => Str::random('50')
            ]);

            if (!in_array(Arr::first($user->getRoleNames()), ['student', 'researcher', 'faculty', 'focal-person','oric-member']) || in_array('super-admin', Arr::flatten($user->getRoleNames()))) {
                dispatch(new SendForgotPasswordEmailJob($user));
            } else {
                dispatch(new SendStudentForgotPasswordEmailJob($user));
            }

            return redirect()->back()->with('success', "Please check your email for reset password link.");
        }

        return redirect()->back()->with('error', "Email doesn't exist.");
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
