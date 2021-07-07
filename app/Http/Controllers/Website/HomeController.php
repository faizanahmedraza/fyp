<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\CMSHome;
use App\Models\CMSHomeIntro;
use App\Models\CMSORICMember;
use App\Models\CMSTestimonial;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $resultSet = CMSHome::latest()->get();
        $aim = CMSHomeIntro::first();
        $orics = User::with('roles')->whereHas('roles',function ($query){
            $query->where('name','oric-member');
        })->orderBy('created_at','desc')->take(4)->get();
        $testimonials = CMSTestimonial::orderBy('created_at','desc')->take(3)->get();
        $blogs = Blog::where('is_active',1)->orderBy('created_at','desc')->take(2)->get();
        return view('website.pages.home',compact('resultSet','aim','orics','testimonials','blogs'));
    }
}
