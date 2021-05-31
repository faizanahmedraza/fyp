<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdminAuthenticationController extends Controller
{
    public function index(){
        return view('cms.authentication.login');
    }

    public function loginData(){
        $validator = Validator::make(request()->all(), [
            'email' => 'required|max:255',
            'password' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        if(!empty(Auth::validate(['email' => request()->email, 'password' => request()->password]))){

            $rememberMe = !empty(request()->remember_me)?:false;

            if(Auth::attempt(['email' => request()->email, 'password' => request()->password],$rememberMe)){
                return redirect('/admin/dashboard');
            }
        }

        return redirect()->back()->with('error', 'Incorrect email or password.');
    }

    public function userVerification($verificationToken){

        if(!empty(User::where('verification_token', $verificationToken)->first())){
            return view('cms.authentication.user_verify', compact('verificationToken'));
        }
        return redirect('/admin/login');
    }

    public function userVerificationData($verificationToken){

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

        if(!empty($user)){

            $user->update([
                'verification_token' => null,
                'is_verified' => 1,
                'password' => request()->password
            ]);

            Auth::loginUsingId($user->id);

            return redirect('/admin/dashboard');
        }

        abort(404);
    }

    public function forgotPassword(){
        return view('cms.authentication.forgot_password');
    }

    public function forgotPasswordData(){

        $user = User::where('email', request()->email)->first();

        if(!empty($user)){

            if(!empty($user->is_block)){
                return redirect()->back()->with('error', 'You are temporary blocked. Kindly contact to your administrator.');
            }

            if(empty($user->is_verified)){
                return redirect()->back()->with('error', 'Please verify your account first.');
            }

            $user->update([
                'verification_token' => Str::random('50')
            ]);

            dispatch(new SendForgotPasswordEmailJob($user));

            return redirect()->back()->with('success', "Please check your email for reset password link.");
        }

        return redirect()->back()->with('error', "Email doesn't exist.");
    }

    public function logout(){
        Auth::logout();
        return redirect('/admin/login');
    }
}
