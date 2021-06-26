<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\CMSHome;
use App\Models\CMSHomeIntro;
use App\Models\CMSORICMember;
use App\Models\CMSTestimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $resultSet = CMSHome::latest()->get();
        $aim = CMSHomeIntro::first();
        $orics = CMSORICMember::orderBy('created_at','desc')->take(3)->get();
        $testimonials = CMSTestimonial::orderBy('created_at','desc')->take(3)->get();
        return view('website.pages.home',compact('resultSet','aim','orics','testimonials'));
    }
}
